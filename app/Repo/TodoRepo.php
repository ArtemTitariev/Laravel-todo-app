<?php

namespace App\Repo;

use Livewire\Component;
use Livewire\WithPagination;

class TodoRepo extends Component
{
    use WithPagination;

    public function save($data)
    {
        $createdTodo = auth()->user()->todos()->create($data);
        // if ($createdTodo) {
        //     return $createdTodo;
        // }
        return $createdTodo ?? null;
    }

    public function update($todoId, $editedTodo)
    {
        $todo = $this->getTodo($todoId);

        return $todo->update([
            'todo' => $editedTodo,
        ]);
    }

    public function getTodo($todoId)
    {
        return auth()->user()->todos()->find($todoId);
    }

    public function getAll()
    {
        $todos = auth()->user()->todos()->latest()->paginate(10);

        return $todos;
    }
}
