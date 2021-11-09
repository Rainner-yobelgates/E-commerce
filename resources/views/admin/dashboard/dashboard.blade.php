@extends('layouts.admin')
@section('title', 'Dashboard')
@section('route')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
</ol>
@stop
@section('content')
<h1>Hello world</h1>
@stop