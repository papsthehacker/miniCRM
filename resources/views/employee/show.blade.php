@extends('welcome')

@section('title', 'Employees - miniCRM')

@section('main_header')
    <h1>{{$employee->first_name}} {{$employee->last_name}}</h1>
@stop

@section('main')
    <p>Welcome to this beautiful admin panel.</p>
@stop
