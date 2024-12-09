@extends('template.main')
@section('content')
    @include('template.head-nav')
    <div class="content">
        @livewire('leavelist')
    </div>
@endsection
