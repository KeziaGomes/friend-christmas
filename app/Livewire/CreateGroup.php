<?php

namespace App\Livewire;

use App\Models\Group;
use App\Models\Participant;
use Livewire\Component;

class CreateGroup extends Component
{
    public string $groupName;
    public string $groupDescription;
    public array $participants = [];

    protected $rules = [
        'groupName' => 'required|string|min:3',
        'groupDescription' => 'nullable|string',
        'participants' => 'required|array|min:2',
        'participants.*' => 'required|string|distinct',
    ];

    public function createGroup()
    {
        $this->validate();

        $group = Group::create([
            'name' => $this->groupName,
            'description' => $this->groupDescription,
        ]);

        $dataParticipant=[];
        foreach ($this->participants as $key => $value) {
            $dataParticipant[] = [
                'name' => $value,
                'group_id' => $group->id,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        Participant::query()->insert($dataParticipant);

        // Mensagem de sucesso
        session()->flash('message', 'Grupo criado com sucesso!');
    }

    public function render()
    {
        return view('livewire.create-group');
    }
}
