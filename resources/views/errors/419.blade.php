@extends('layouts.app')

@section('title', __('messages.errors.419.title') . ' - ' . setting('app_nama', 'PASEBAN'))

@section('content')
<div class="flex flex-col items-center justify-center min-h-[70vh] text-center px-4">
    <h1 class="text-6xl font-bold text-blue-600 mb-4 font-['JetBrains_Mono']">419</h1>
    <h2 class="text-2xl font-semibold text-gray-800 mb-4">{{ __('messages.errors.419.title') }}</h2>
    <p class="text-gray-600 max-w-md mb-8 leading-relaxed">
        {{ __('messages.errors.419.message') }}
    </p>
    <div class="flex gap-4">
        <a href="javascript:location.reload()" class="bg-navy text-white px-6 py-3 rounded-lg hover:bg-navy-900 transition duration-300 font-medium text-sm">
            {{ __('messages.errors.reload') }}
        </a>
        <a href="{{ url('/') }}" class="border border-gray-300 text-gray-700 px-6 py-3 rounded-lg hover:bg-gray-100 transition duration-300 font-medium text-sm">
            {{ __('messages.errors.back_home') }}
        </a>
    </div>
</div>
@endsection
