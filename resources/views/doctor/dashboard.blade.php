@extends('doctor.layout')

@section('title', 'Dashboard Dokter')

@section('content')
    @include('doctor.partials.panel_full', ['appointments' => $appointments, 'doctor' => $doctor, 'date' => $date])
@endsection
