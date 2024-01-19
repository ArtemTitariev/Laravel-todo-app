<div>
    <div class="flex justify-center">
        <x-input-error :messages="$errors->get('todo')" class="mt-2" />
    </div>

    <form class="flex" method="POST" wire:submit.prevent="createTodo">
        <x-text-input wire:model="todo" class="w-full mr-2" />

        <x-primary-button>
            {{ __('Add') }}
        </x-primary-button>
    </form>
    <br>

    @forelse ($todos as $todo)
        <div class="flex mt-5 py-4 justify-between">
            <div class="my-auto">
                <input id="checkbox{{ $todo->id }}" type="checkbox" wire:click="markComplered({{ $todo->id }})"
                    @if ($todo->is_completed) checked @else unchecked @endif
                    class="w-4 h-4 text-green-600 bg-gray-100 border-gray-300 rounded focus:ring-green-500 dark:focus:ring-green-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
            </div>
            <div class="w-7/12">
                @if ($editTodoId === $todo->id)
                    <div class="flex justify-center">
                        <x-input-error :messages="$errors->get('editedTodo')" />
                    </div>

                    <x-textarea id="area{{ $todo->id }}" wire:model="editedTodo" class="w-full mr-2" />
                @else
                    <span class="break-all @if ($todo->is_completed) text-green-600 @endif">
                        {{ $todo->todo }}
                    </span>
                @endif

            </div>

            <div class="my-auto justify-between">
                @if ($editTodoId === $todo->id)
                    <x-secondary-button wire:click="updateTodo({{ $todo->id }})">
                        {{ __('Update') }}
                    </x-secondary-button>
                    <x-danger-button wire:click="cancelEdit">
                        {{ __('Cancel') }}
                    </x-danger-button>
                @else
                    <x-secondary-button wire:click="editTodo({{ $todo->id }})">
                        {{-- onclick="document.getElementById('area{{ $todo->id }}').select();" --}}
                        {{ __('Edit') }}
                    </x-secondary-button>
                    <x-danger-button wire:click="deleteTodo({{ $todo->id }})">
                        {{ __('Delete') }}
                    </x-danger-button>
                @endif
            </div>

        </div>

    @empty
        <div class="flex mt-5 py-4 justify-between">
            {{ __('You do not have any Todo yet.') }}
        </div>
    @endforelse


    <div class="mt-5">
        {{ $todos->links() }}
    </div>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            @if (session()->has('message'))
                <div wire:poll="clearMessage"
                    class="bg-gray-100 border-t-4 border-green-600 rounded-b text-gray-800 px-4 py-3 shadow-md text-sm fixed bottom-4 right-4"
                    role="alert">
                    {{ session('message') }}
                </div>
            @endif
        </div>
    </div>

</div>
