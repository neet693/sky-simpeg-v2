<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
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
                            <p class="font-semibold editable" contenteditable="true" data-field="title">
                                {{ $task->title }}</p>
                            <p class="font-semibold editable" contenteditable="true" data-field="description">
                                {{ $task->description ? $task->description : 'Tidak ada' }}</p>
                            <button class="text-red-600" wire:click="deleteTask({{ $task->id }})">
                                Hapus
                            </button>
                        </div>
                    @endforeach
                </td>
                <td id="inProgressColumn" class="taskColumn p-2 space-y-4">
                    @foreach ($tasks->where('status', 'In Progress')->sortBy('order') as $task)
                        <div class="task bg-white p-4 mb-4 rounded-lg shadow-lg cursor-grab hover:shadow-xl"
                            data-id="{{ $task->id }}" data-order="{{ $task->order }}" data-status="In Progress">
                            <p class="font-semibold editable" contenteditable="true" data-field="title">
                                {{ $task->title }}</p>
                            <p class="font-semibold editable" contenteditable="true" data-field="description">
                                {{ $task->description ? $task->description : 'Tidak ada' }}</p>
                            <button class="text-red-600" wire:click="deleteTask({{ $task->id }})">
                                Hapus
                            </button>
                        </div>
                    @endforeach
                </td>
                <td id="doneColumn" class="taskColumn p-2 space-y-4">
                    @foreach ($tasks->where('status', 'Done')->sortBy('order') as $task)
                        <div class="task bg-white p-4 mb-4 rounded-lg shadow-lg cursor-grab hover:shadow-xl"
                            data-id="{{ $task->id }}" data-order="{{ $task->order }}" data-status="Done">
                            <p class="font-semibold editable" contenteditable="true" data-field="title">
                                {{ $task->title }}</p>
                            <p class="font-semibold editable" contenteditable="true" data-field="description">
                                {{ $task->description ? $task->description : 'Tidak ada' }}</p>
                            <button class="text-red-600" wire:click="deleteTask({{ $task->id }})">
                                Hapus
                            </button>
                        </div>
                    @endforeach
                </td>
            </tr>
        </tbody>
    </table>
    @if ($isConfirmingDelete)
        <div class="fixed inset-0 flex items-center justify-center bg-gray-500 bg-opacity-50 z-50">
            <div class="bg-white p-6 rounded-lg shadow-lg w-96">
                <p class="text-lg font-semibold">Apakah Anda yakin ingin menghapus task ini?</p>
                <div class="mt-4 flex justify-end space-x-4">
                    <button wire:click="deleteTask" class="bg-red-500 text-white px-4 py-2 rounded-lg">Hapus</button>
                    <button wire:click="$set('isConfirmingDelete', false)"
                        class="bg-gray-300 text-gray-700 px-4 py-2 rounded-lg">Batal</button>
                </div>
            </div>
        </div>
    @endif
</div>
