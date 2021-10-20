<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Card;

class Cards extends Component
{

    public $cards, $title, $description;
    public $isOpen = false;

    public function render()
    {
        $this->cards = Card::all();
        return view('livewire.cards.cards');
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
        $this->card_id = null;
    }

    public function store()
    {
        $this->validate([
            'title' => 'required',
            'description' => 'required'
        ]);
        Card::updateOrCreate(['id' => $this->card_id], [
            'title' => $this->title,
            'description' => $this->description
        ]);
        session()->flash('message',
            $this->card_id ? 'Card Updated Successfully.' : 'Card Created Successfully.');
        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $card = Card::findOrFail($id);
        $this->card_id = $card->id;
        $this->title = $card->title;
        $this->description = $card->description;
        $this->openModal();
    }

    public function delete($id)
    {
        Card::find($id)->delete();
        session()->flash('message', 'Card Deleted Successfully.');
    }
}
