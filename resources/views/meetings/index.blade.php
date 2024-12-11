@extends('template.main')
@section('content')
    @include('template.head-nav')
    <div class="content">
        @livewire('meeting-list')
    </div>
@endsection
