<?php

namespace Tests\Feature;

use Tests\TestCase;
use Livewire\Livewire;
use App\Livewire\PublicAliranDataTable;

class AliranDataTest extends TestCase
{
    /**
     * Test public aliran data route responds with 200.
     */
    public function test_public_aliran_data_page_accessible(): void
    {
        $response = $this->get('/aliran-data');
        $response->assertStatus(200);
        $response->assertSeeLivewire('public-aliran-data-table');
    }

    /**
     * Test parse_relative_time_to_minutes helper accuracy.
     */
    public function test_parse_relative_time_helper(): void
    {
        $this->assertEquals(240, parse_relative_time_to_minutes('4 jam yang lalu'));
        $this->assertEquals(1440, parse_relative_time_to_minutes('1 hari yang lalu'));
        $this->assertEquals(2880, parse_relative_time_to_minutes('2 hari yang lalu'));
        $this->assertEquals(10080, parse_relative_time_to_minutes('1 minggu yang lalu'));
        $this->assertEquals(30240, parse_relative_time_to_minutes('3 minggu yang lalu'));
        $this->assertEquals(43200, parse_relative_time_to_minutes('1 bulan yang lalu'));
        $this->assertEquals(525600, parse_relative_time_to_minutes('1 tahun yang lalu'));
        $this->assertEquals(PHP_INT_MAX, parse_relative_time_to_minutes('-'));
        $this->assertEquals(PHP_INT_MAX, parse_relative_time_to_minutes(null));

        // 4 hours should be smaller (newer) than 3 weeks
        $this->assertTrue(
            parse_relative_time_to_minutes('4 jam yang lalu') < parse_relative_time_to_minutes('3 minggu yang lalu')
        );
    }

    /**
     * Test livewire component sorts by newest by default.
     */
    public function test_livewire_component_defaults_to_terbaru(): void
    {
        Livewire::test(PublicAliranDataTable::class)
            ->assertSet('sortBy', 'terbaru')
            ->assertSee('Pemutakhiran: Terbaru')
            ->assertSee('4 jam yang lalu');
    }

    /**
     * Test livewire component searching and sorting.
     */
    public function test_livewire_component_search_and_sorting(): void
    {
        Livewire::test(PublicAliranDataTable::class)
            ->set('sortBy', 'terlama')
            ->assertSet('sortBy', 'terlama')
            ->set('search', 'PDAM')
            ->assertSet('search', 'PDAM')
            ->assertSee('PDAM');
    }
}
