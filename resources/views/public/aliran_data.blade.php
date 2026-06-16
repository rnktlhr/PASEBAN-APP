@extends('layouts.app')

@section('content')
    <livewire:public-aliran-data-table :tahun="$tahun" />
@endsection
