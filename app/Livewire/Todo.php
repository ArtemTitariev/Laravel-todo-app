<?php

namespace App\Livewire;

use App\Repo\TodoRepo;
use Illuminate\Auth\Events\Validated;
use Livewire\Component;
use Livewire\Attributes\Rule;

class Todo extends Component
{
    protected $repo;

    #[Rule('required|min:3|max:255')]

    public $todo = null;

    public $editTodoId;

    #[Rule('required|min:3|max:255')]

    public $editedTodo;

    public function boot(TodoRepo $repo)
    {
        $this->repo = $repo;
    }

    public function createTodo()
    {
        $validated = $this->validateOnly('todo');

        $this->repo->save($validated);
        $this->todo = null;
    }

    public function editTodo($todoId)
    {
        $this->editTodoId = $todoId;
        $this->editedTodo = $this->repo->getTodo($todoId)->todo;
    }

    public function updateTodo($todoId)
    {
        $validated = $this->validateOnly('editedTodo');
        $this->repo->update($todoId, $validated['editedTodo']);
        $this->cancelEdit();
    }

    public function cancelEdit()
    {
        $this->editTodoId = null;
    }

    public function render()
    {
        $todos = $this->repo->getAll();

        return view('livewire.todo', compact('todos'));
    }
}
