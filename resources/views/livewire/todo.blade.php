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
                <input id="green-checkbox" type="checkbox"
                    class="w-4 h-4 text-green-600 bg-gray-100 border-gray-300 rounded focus:ring-green-500 dark:focus:ring-green-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
            </div>
            <div>
                @if ($editTodoId === $todo->id)
                    <x-input-error :messages="$errors->get('editedTodo')" />

                    <x-text-input wire:model="editedTodo" class="w-full mr-2" />
                @else
                    {{ $todo->todo }}
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
                        {{ __('Edit') }}
                    </x-secondary-button>
                    <x-danger-button wire:click="deleteTodo({{ $todo->id }})">
                        {{ __('Delete') }}
                    </x-danger-button>
                @endif
            </div>

        </div>

    @empty
    @endforelse


    <div class="mt-5">
        {{ $todos->links() }}
        <div>

        </div>
