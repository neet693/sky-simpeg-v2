@extends('template.main')
@section('content')
    @include('template.head-nav')
    <div class="content">
        @livewire('assignment-component')
    </div>
@endsection
