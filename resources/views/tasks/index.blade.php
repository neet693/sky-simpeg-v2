@extends('template.main')
@section('content')
    @include('template.head-nav')

    <div class="row">
        <div class="col-6">
            <h2 class="content-title">Pekerjaan Hari ini</h2>
            <h5 class="content-desc mb-4">Apa yang mau anda kerjakan hari ini?</h5>
        </div>
        <div class="col-6 d-flex justify-content-center">
            @livewire('task-modal')
        </div>
    </div>

    <div class="content">
        <div class="overflow-x-auto bg-gray-100 p-4 rounded-lg shadow-lg">
            @livewire('task-list', ['tasks' => $tasks])

        </div>
    </div>
@endsection
