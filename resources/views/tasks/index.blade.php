@extends('template.main')
@section('content')
    @include('template.head-nav')
    <div class="content">
        <div class="overflow-x-auto bg-gray-100 p-4 rounded-lg shadow-lg">
            <table class="min-w-full border-collapse text-left text-sm text-gray-700">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="py-3 px-4 font-medium text-gray-600">To Do</th>
                        <th class="py-3 px-4 font-medium text-gray-600">In Progress</th>
                        <th class="py-3 px-4 font-medium text-gray-600">Done</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td id="todoColumn" class="taskColumn p-2 space-y-4">
                            @foreach ($tasks->where('status', 'To Do')->sortBy('order') as $task)
                                <div class="task bg-white p-4 mb-4 rounded-lg shadow-lg cursor-grab hover:shadow-xl"
                                    data-id="{{ $task->id }}" data-order="{{ $task->order }}" data-status="To Do">
                                    <p class="font-semibold">{{ $task->title }}</p>
                                </div>
                            @endforeach
                        </td>
                        <td id="inProgressColumn" class="taskColumn p-2 space-y-4">
                            @foreach ($tasks->where('status', 'In Progress')->sortBy('order') as $task)
                                <div class="task bg-white p-4 mb-4 rounded-lg shadow-lg cursor-grab hover:shadow-xl"
                                    data-id="{{ $task->id }}" data-order="{{ $task->order }}"
                                    data-status="In Progress">
                                    <p class="font-semibold">{{ $task->title }}</p>
                                </div>
                            @endforeach
                        </td>
                        <td id="doneColumn" class="taskColumn p-2 space-y-4">
                            @foreach ($tasks->where('status', 'Done')->sortBy('order') as $task)
                                <div class="task bg-white p-4 mb-4 rounded-lg shadow-lg cursor-grab hover:shadow-xl"
                                    data-id="{{ $task->id }}" data-order="{{ $task->order }}" data-status="Done">
                                    <p class="font-semibold">{{ $task->title }}</p>
                                </div>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
