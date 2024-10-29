<?php

namespace App\Livewire;

use App\Models\Group;
use App\Models\Participant;
use Illuminate\Support\Str;
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
            'uuid' => Str::uuid()->toString(),
            'name' => $this->groupName,
            'description' => $this->groupDescription,
        ]);

        $dataParticipant=[];
        foreach ($this->participants as $key => $value) {
            $dataParticipant[] = [
                'uuid' => Str::uuid()->toString(),
                'name' => $value,
                'group_id' => $group->id,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        Participant::query()->insert($dataParticipant);

        //sorteando os participantes cada participantes apenas um participante diferente de si mesmo
        $group->loadMissing('participants');
        $participants = $group->participants->shuffle();
        $quantidade = $participants->count();

        for ($i=0; $i < $quantidade; $i++) {
            $amigoOculto = $participants[($i+1) % $quantidade];
            $participants[$i]->update(['amigo_oculto_id' => $amigoOculto->id]);
        }

        session()->flash('message', 'Grupo criado com sucesso!');

        return redirect()->route('groups.show', $group->uuid);
    }

    public function render()
    {
        return view('livewire.create-group');
    }
}
