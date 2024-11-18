<div>
    {{-- The best athlete wants his opponent at his best. --}}
    <div>
        <!-- Tombol untuk membuka modal -->
        <button wire:click="open" class="btn btn-primary">Add Task</button>

        <!-- Modal -->
        <div class="fixed inset-0 flex items-center justify-center bg-gray-500 bg-opacity-75 transition-opacity z-50"
            style="{{ $isOpen ? 'opacity: 1; pointer-events: auto;' : 'opacity: 0; pointer-events: none;' }}">
            <div class="bg-white rounded-lg p-6 shadow-lg max-w-lg w-full mx-auto">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Add Task</h3>
                <form wire:submit.prevent="saveTask">
                    <div class="mb-4">
                        <label for="title" class="block text-sm font-medium text-gray-700">Task Title</label>
                        <input type="text" id="title" wire:model="title" class="w-full mt-1 p-2 border rounded"
                            placeholder="Enter task title">
                        @error('title')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="description" class="block text-sm font-medium text-gray-700">Task
                            Description</label>
                        <textarea id="description" wire:model="description" class="w-full mt-1 p-2 border rounded"
                            placeholder="Enter task description"></textarea>
                        @error('description')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="status" class="block text-sm font-medium text-gray-700">Task Status</label>
                        <select id="status" wire:model="status" class="w-full mt-1 p-2 border rounded">
                            <option value="" disabled>Select status</option>
                            <option value="To Do">To Do</option>
                            <option value="In Progress">In Progress</option>
                            <option value="Done">Done</option>
                        </select>
                        @error('status')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex justify-end gap-2">
                        <button type="button" wire:click="close"
                            class="bg-gray-500 text-white px-4 py-2 rounded">Cancel</button>
                        <button type="submit" wire:click="saveTask"
                            class="bg-blue-500 text-white px-4 py-2 rounded">Save Task</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
