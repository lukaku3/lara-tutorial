<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Todo;

class Todos extends Component
{
    public $todos, $title, $description, $todo_id;
    public $isOpen=false;

    public function render()
    {
        $this->todos = Todo::all();
        return view('livewire.todos');
    }

    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    public function resetInputFields()
    {
        $this->title = '';
        $this->description = '';
        $this->todo_id = null;
    }

    public function store()
    {
        $this->validate([
            'title' => 'required',
            'description' => 'required'
        ]);
        Todo::updateOrCreate(['id' => $this->todo_id], [
            'title' => $this->title,
            'description' => $this->description
        ]);
        session()->flash('message',
            $this->todo_id ? 'Todo Updated Successfully.' : 'Todo Created Successfully.');
        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $todo = Todo::findOrFail($id);
        $this->todo_id = $todo->id;
        $this->title = $todo->title;
        $this->description = $todo->description;
        $this->openModal();
    }

    public function delete($id)
    {
        Todo::find($id)->delete();
        session()->flash('message', 'Todo Deleted Successfully.');
    }
}
