<?php

namespace App\Livewire;

use App\Models\Group;
use Livewire\Component;

class CreateGroup extends Component
{
    public $groupName;
    public $groupDescription;
    public $participants = [];

    protected $rules = [
        'groupName' => 'required|string|min:3',
        'groupDescription' => 'nullable|string',
        'participants' => 'required|array|min:2',
        'participants.*' => 'required|string|distinct',
    ];

    public function createGroup()
    {
        $this->validate();

        // Cria o grupo e salva os participantes
        Group::create([
            'name' => $this->groupName,
            'description' => $this->groupDescription,
            // Salvar participantes logicamente com relacionamento ou em uma tabela separada
        ]);

        // Mensagem de sucesso
        session()->flash('message', 'Grupo criado com sucesso!');
    }

    public function render()
    {
        return view('livewire.create-group');
    }
}
