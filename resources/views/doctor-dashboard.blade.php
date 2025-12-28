@extends('doctor.layout')

@section('title', 'Dashboard Dokter')

@section('content')
    @include('doctor.partials.panel_full', [
        'appointments' => $appointments ?? (function_exists('collect') ? collect() : []),
        'doctor' => $doctor ?? (auth()->user()->doctor ?? null),
        'date' => $date ?? now()->toDateString(),
    ])
@endsection
