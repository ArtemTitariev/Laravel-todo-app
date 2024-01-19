<?php

namespace App\Repo;

use Livewire\Component;
use Livewire\WithPagination;

class TodoRepo extends Component
{
    use WithPagination;

    public function save($data)
    {
        return auth()->user()->todos()->create($data);
        // if ($createdTodo) {
        //     return $createdTodo;
        // }
        //return $createdTodo ?? null;
    }

    public function update($todoId, $editedTodo)
    {
        $todo = $this->get($todoId);

        return $todo->update([
            'todo' => $editedTodo,
        ]);
    }

    public function delete($todoId)
    {
        return $this->get($todoId)->deleteTodo();
    }

    public function get($todoId)
    {
        return auth()->user()->todos()->find($todoId);
    }

    public function getAll()
    {
        $todos = auth()->user()->todos()->latest()->paginate(10);

        return $todos;
    }
}
