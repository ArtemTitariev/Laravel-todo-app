<?php

namespace App\Repo;

use Livewire\Component;
use Livewire\WithPagination;

class TodoRepo extends Component
{
    use WithPagination;

    public function save($data)
    {
        try {
            $todo = auth()->user()->todos()->create($data);
            $this->notify(__('Todo successfully created!'));
            return $todo;
        } catch (\Exception $e) {
            $this->notify(__('Failed to create Todo. Please try again.'));
            return null;
        }
    }

    public function update($todoId, $editedTodo)
    {
        try {
            $todo = $this->get($todoId);
            $todo->update([
                'todo' => $editedTodo,
            ]);
            $this->notify(__('Todo successfully updated!'));
            return true;
        } catch (\Exception $e) {
            $this->notify(__('Failed to update Todo. Please try again.'));
            return false;
        }
    }

    public function delete($todoId)
    {
        try {
            $todo = $this->get($todoId);
            $todo->delete();
            $this->notify(__('Todo successfully deleted!'));
            return true;
        } catch (\Exception $e) {
            $this->notify(__('Failed to delete Todo. Please try again.'));
            return false;
        }
    }


    public function completed($todoId)
    {
        $todo = $this->get($todoId);
        try {
            $todo->update(['is_completed' => !$todo->is_completed]);
            $this->notify(__('Todo status changed successfully!'));
            return true;
        } catch (\Exception $e) {
            $this->notify(__('Failed to change Todo status. Please try again.'));
            return false;
        }
    }

    public function get($todoId)
    {
        return auth()->user()->todos()->find($todoId);
    }

    public function getAll()
    {
        $todos = auth()->user()->todos()
            ->orderBy('is_completed')
            ->orderBy('created_at')
            ->latest()->paginate(10);

        return $todos;
    }

    public function notify($message)
    {
        session()->flash('message', $message);
    }

    public function clearMessage()
    {
        session()->forget('message');
    }
}
