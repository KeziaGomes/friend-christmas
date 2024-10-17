<div x-data="groupForm()" class="max-w-3xl p-8 mx-auto bg-white rounded-lg shadow">
    <!-- Timeline de Etapas -->
    <div class="flex items-center justify-between mb-8">
        <div class="flex items-center">
            <div :class="{'bg-blue-500 text-white': step === 1, 'bg-gray-300 text-gray-500': step !== 1}"
                class="flex items-center justify-center w-10 h-10 font-bold rounded-full">
                1
            </div>
            <div :class="{'border-blue-500': step >= 2, 'border-gray-300': step < 2}"
                class="flex-1 border-t-4"></div>
        </div>
        <div class="flex items-center">
            <div :class="{'bg-blue-500 text-white': step === 2, 'bg-gray-300 text-gray-500': step !== 2}"
                class="flex items-center justify-center w-10 h-10 font-bold rounded-full">
                2
            </div>
            <div :class="{'border-blue-500': step >= 3, 'border-gray-300': step < 3}"
                class="flex-1 border-t-4"></div>
        </div>
        <div class="flex items-center">
            <div :class="{'bg-blue-500 text-white': step === 3, 'bg-gray-300 text-gray-500': step !== 3}"
                class="flex items-center justify-center w-10 h-10 font-bold rounded-full">
                3
            </div>
        </div>
    </div>

    <!-- Etapas do Formulário -->
    <!-- Etapa 1: Informações do Grupo -->
    <div x-show="step === 1" class="space-y-4">
        <div>
            <label for="groupName" class="block text-sm font-medium text-gray-700">Nome do Grupo</label>
            <input type="text" x-model="groupName" id="groupName" class="block w-full p-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>
        <div>
            <label for="groupDescription" class="block text-sm font-medium text-gray-700">Descrição</label>
            <textarea x-model="groupDescription" id="groupDescription" class="block w-full p-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"></textarea>
        </div>
        <div class="flex justify-between mt-6">
            <span></span> <!-- Espaço vazio para centralizar o botão -->
            <button type="button" class="px-4 py-2 text-white bg-blue-500 rounded hover:bg-blue-600" @click="step = 2">Próximo</button>
        </div>
    </div>

    <!-- Etapa 2: Adicionar Participantes -->
    <div x-show="step === 2" class="space-y-4">
        <div>
            <label for="participantName" class="block text-sm font-medium text-gray-700">Nome do Participante</label>
            <input type="text" x-model="participantName" id="participantName" class="block w-full p-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            <button type="button" @click="addParticipant" class="px-4 py-2 mt-2 text-white bg-blue-500 rounded hover:bg-blue-600">Adicionar Participante</button>
        </div>

        <!-- Lista de Participantes -->
        <ul class="space-y-2">
            <template x-for="(participant, index) in participants" :key="index">
                <li class="flex items-center justify-between p-3 bg-gray-100 rounded-md">
                    <span x-text="participant" class="text-gray-700"></span>
                    <button type="button" @click="removeParticipant(index)" class="text-red-500 hover:text-red-700">
                        Remover
                    </button>
                </li>
            </template>
        </ul>

        <div class="flex justify-between mt-6">
            <button type="button" class="px-4 py-2 text-gray-700 bg-gray-300 rounded hover:bg-gray-400" @click="step = 1">Voltar</button>
            <button type="button" class="px-4 py-2 text-white bg-blue-500 rounded hover:bg-blue-600" @click="step = 3">Próximo</button>
        </div>
    </div>

    <!-- Etapa 3: Resumo -->
    <div x-show="step === 3" class="space-y-4">
        <h3 class="text-lg font-medium text-gray-700">Resumo do Grupo</h3>
        <p class="text-sm text-gray-700"><strong>Nome do Grupo:</strong> <span x-text="groupName"></span></p>
        <p class="text-sm text-gray-700"><strong>Descrição do Grupo:</strong> <span x-text="groupDescription"></span></p>

        <h4 class="mt-4 text-lg font-medium text-gray-700">Participantes</h4>
        <ul class="space-y-2">
            <template x-for="participant in participants" :key="participant">
                <li class="p-3 text-gray-700 bg-gray-100 rounded-md" x-text="participant"></li>
            </template>
        </ul>

        <div class="flex justify-between mt-6">
            <button type="button" class="px-4 py-2 text-gray-700 bg-gray-300 rounded hover:bg-gray-400" @click="step = 2">Voltar</button>
            <button type="button" class="px-4 py-2 text-white bg-green-500 rounded hover:bg-green-600" @click="submitForm">Criar Grupo</button>
        </div>
    </div>

    <!-- Mensagem de sucesso -->
    @if (session()->has('message'))
        <div class="p-4 mt-4 text-green-800 bg-green-100 rounded-md">
            {{ session('message') }}
        </div>
    @endif
</div>

<script>
    function groupForm() {
        return {
            step: 1,
            groupName: '',
            groupDescription: '',
            participantName: '',
            participants: [],

            addParticipant() {
                if (this.participantName.trim() !== '') {
                    this.participants.push(this.participantName);
                    this.participantName = '';
                }
            },

            removeParticipant(index) {
                this.participants.splice(index, 1);
            },

            submitForm() {
                @this.set('groupName', this.groupName);
                @this.set('groupDescription', this.groupDescription);
                @this.set('participants', this.participants);

                // Chama o método Livewire para criar o grupo
                @this.call('createGroup');
            }
        }
    }
</script>
