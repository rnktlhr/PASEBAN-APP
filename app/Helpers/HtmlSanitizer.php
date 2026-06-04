<?php

namespace App\Helpers;

/**
 * HTML Sanitizer for user-generated rich-text content.
 *
 * Strips dangerous tags (script, iframe, object, embed, form, etc.)
 * and dangerous attributes (onclick, onerror, onload, javascript: hrefs, etc.)
 * while preserving safe formatting tags from RichEditor output.
 */
class HtmlSanitizer
{
    /**
     * Tags allowed in sanitized output (safe formatting only).
     */
    private const ALLOWED_TAGS = [
        'p', 'br', 'strong', 'b', 'em', 'i', 'u', 's', 'del',
        'ul', 'ol', 'li',
        'h1', 'h2', 'h3', 'h4', 'h5', 'h6',
        'a', 'img', 'figure', 'figcaption',
        'blockquote', 'pre', 'code',
        'table', 'thead', 'tbody', 'tr', 'th', 'td',
        'div', 'span', 'hr', 'sub', 'sup',
    ];

    /**
     * Attributes allowed on specific tags.
     */
    private const ALLOWED_ATTRIBUTES = [
        'a'     => ['href', 'title', 'target', 'rel'],
        'img'   => ['src', 'alt', 'width', 'height', 'title'],
        'td'    => ['colspan', 'rowspan'],
        'th'    => ['colspan', 'rowspan'],
        '*'     => ['class', 'id', 'style'],
    ];

    /**
     * Patterns that indicate a malicious attribute value.
     */
    private const DANGEROUS_VALUE_PATTERNS = [
        '/javascript\s*:/i',
        '/vbscript\s*:/i',
        '/data\s*:[^image]/i',
        '/expression\s*\(/i',
    ];

    /**
     * Sanitize HTML string, removing dangerous content.
     */
    public static function clean(?string $html): string
    {
        if (empty($html)) {
            return '';
        }

        // Wrap in a root element for DOMDocument parsing
        $wrapped = '<div id="__sanitizer_root__">' . $html . '</div>';

        $dom = new \DOMDocument('1.0', 'UTF-8');

        // Suppress warnings from malformed HTML
        libxml_use_internal_errors(true);
        $dom->loadHTML(
            '<?xml encoding="UTF-8">' . $wrapped,
            LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD
        );
        libxml_clear_errors();

        // Process the DOM tree
        $root = $dom->getElementById('__sanitizer_root__');
        if ($root) {
            self::sanitizeNode($root);
        }

        // Extract the sanitized inner HTML
        $output = '';
        if ($root) {
            foreach ($root->childNodes as $child) {
                $output .= $dom->saveHTML($child);
            }
        }

        return $output;
    }

    /**
     * Recursively sanitize a DOM node and its children.
     */
    private static function sanitizeNode(\DOMNode $node): void
    {
        $removeNodes = [];

        foreach ($node->childNodes as $child) {
            if ($child->nodeType === XML_ELEMENT_NODE) {
                /** @var \DOMElement $child */
                $tagName = strtolower($child->nodeName);

                // Remove disallowed tags entirely
                if (!in_array($tagName, self::ALLOWED_TAGS, true)) {
                    $removeNodes[] = $child;
                    continue;
                }

                // Sanitize attributes
                self::sanitizeAttributes($child, $tagName);

                // Recurse into children
                self::sanitizeNode($child);
            }
        }

        // Remove nodes marked for deletion
        foreach ($removeNodes as $removeNode) {
            $node->removeChild($removeNode);
        }
    }

    /**
     * Remove disallowed attributes and dangerous attribute values.
     */
    private static function sanitizeAttributes(\DOMElement $element, string $tagName): void
    {
        $allowedForTag = self::ALLOWED_ATTRIBUTES[$tagName] ?? [];
        $allowedGlobal = self::ALLOWED_ATTRIBUTES['*'] ?? [];
        $allowedAll = array_merge($allowedForTag, $allowedGlobal);

        $removeAttrs = [];

        foreach ($element->attributes as $attr) {
            $attrName = strtolower($attr->nodeName);

            // Remove event handlers (on*)
            if (str_starts_with($attrName, 'on')) {
                $removeAttrs[] = $attr->nodeName;
                continue;
            }

            // Remove attributes not in whitelist
            if (!in_array($attrName, $allowedAll, true)) {
                $removeAttrs[] = $attr->nodeName;
                continue;
            }

            // Check for dangerous values
            $value = $attr->nodeValue;
            foreach (self::DANGEROUS_VALUE_PATTERNS as $pattern) {
                if (preg_match($pattern, $value)) {
                    $removeAttrs[] = $attr->nodeName;
                    break;
                }
            }
        }

        foreach ($removeAttrs as $attrName) {
            $element->removeAttribute($attrName);
        }

        // Force rel="noopener noreferrer" on links with target="_blank"
        if ($tagName === 'a' && $element->getAttribute('target') === '_blank') {
            $element->setAttribute('rel', 'noopener noreferrer');
        }
    }
}
