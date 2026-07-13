<?php

use Livewire\Component;

new class extends Component
{
    public $name='';
    public $email='';

    protected $rules = [
        'name' => 'required|min:3',
        'email' => 'required|email',
    ];

    public function updated($propertyName){
        $this->validateOnly($propertyName);
    }

    public function submit(){
        $this->validate();
        session()->flash('message', "Terimakasih, {$this->name}!");
        $this->reset();
    }
};
?>

<div>
    @if (session()->has('message'))
        <p style="color:green">{{session('message')}}</p>
    @endif

    <input type="text" wire:model.blur="name" placeholder="Nama">
    @error('name')
        <span style="color:red">{{ $message }}</span>
    @enderror

    <input type="text" wire:model.blur="email" placeholder="Email">
    @error('email')
        <span style="color: red">{{ $message }}</span>
    @enderror

    <button wire:click="submit">Kirim</button>
</div>
