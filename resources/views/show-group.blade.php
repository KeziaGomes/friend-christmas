<x-app-layout>
    <div class="pt-8 pb-12 bg-gray-100">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Título do Grupo -->
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h1 class="text-3xl font-bold text-gray-800 mb-4">{{ $group->name }}</h1>
                <p class="text-gray-600 mb-6">{{ $group->description }}</p>

                <label for="groupLink" class="text-gray-700 font-semibold">Salve o link do seu grupo copiando abaixo:</label>
                <!-- Copiar link do grupo -->
                <div class="flex items-center space-x-2 mb-6">
                    <input
                        id="groupLink"
                        type="text"
                        readonly
                        value="{{ route('groups.show', ['group' => $group->uuid]) }}"
                        class="border rounded-lg p-2 w-full bg-gray-100 text-gray-800"
                    >

                    <button onclick="copyGroupLink()" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition">
                        Copiar Link
                    </button>
                </div>


                <!-- Lista de Participantes -->
                <div class="bg-gray-50 rounded-lg p-4 shadow-inner">
                    <h2 class="text-xl font-semibold text-gray-700 mb-4">Participantes</h2>
                    <ul class="space-y-2">
                        @foreach ($group->participants as $participant)
                            <li class="flex items-center bg-white border rounded-lg p-3 shadow-sm hover:bg-gray-100 transition">
                                <div class="flex-grow">
                                    <a
                                        href="{{ route('participant.show', ['participant' => $participant->uuid]) }}"
                                        class="text-lg font-medium text-gray-800">
                                        👤 {{ $participant->name }}
                                    </a>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <script>
        function copyGroupLink() {
            // Seleciona o campo de input
            var copyText = document.getElementById("groupLink");
            copyText.select();
            copyText.setSelectionRange(0, 99999); // Para dispositivos móveis

            // Copia o texto para a área de transferência
            document.execCommand("copy");

            // Mensagem de confirmação
            alert("Link do grupo copiado!");
        }
    </script>
</x-app-layout>
