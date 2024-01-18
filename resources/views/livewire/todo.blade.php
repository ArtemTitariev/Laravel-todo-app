<div>
    <div class="flex justify-center">
    <x-input-error :messages="$errors->get('todo')" class="mt-2" />
    </div>

    <form class="flex" method="POST" >
    <x-text-input  class="w-full mr-2"/>
    
    <x-primary-button >
        Add
    </x-primary-button>
    </form>
    <br>
    
        {{-- First todo --}}
    <div class="flex mt-5 py-4 justify-between">
    <div>
    <input id="green-checkbox"  type="checkbox" class="w-4 h-4 text-green-600 bg-gray-100 border-gray-300 rounded focus:ring-green-500 dark:focus:ring-green-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
    </div>
    <div>
    Todo
    </div>

    <div>
    
    <x-secondary-button >
    Edit
    </x-secondary-button>
    <x-danger-button >
    Delete
    </x-danger-button>
    </div>
    
    </div>
    


    <div class="mt-5">
    {{-- Pagination links --}}
    <div>

</div>