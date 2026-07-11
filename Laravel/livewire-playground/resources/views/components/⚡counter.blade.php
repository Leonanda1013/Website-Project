<?php

use Livewire\Component;

new class extends Component
{
    public $count =0;

    public function increment(){
        $this->count++;
    }

    public function decrement(){
        $this->count--;
    }
};
?>

<div>
    <h2>Jumlah: {{$count}}</h2>
    <button wire:click="increment">Tambah</button>
    <button wire:click="decrement">Kurang</button>
</div>
