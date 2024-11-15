<!-- resources/views/employees/index.blade.php -->

@extends('template.main')
@section('content')
    @include('template.head-nav')
    <div class="content">
        @livewire('employee-list')
    </div>
@endsection
