@extends('layouts.app')

@section('title', 'Monitoring & Evaluasi — Paseban')

@section('content')
<section style="padding: 72px 0; background: #fff; border-bottom: 1px solid var(--line); min-height: 80vh;">
    <div class="container">
        <livewire:monev-calendar :tahun-awal="$tahun" />
    </div>
</section>
@endsection
