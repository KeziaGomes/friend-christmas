<x-app-layout>
    <div class="pt-8 pb-12 bg-gray-100">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow-lg p-6 space-y-6">
                <h1 class="text-2xl font-bold text-gray-800 mb-4">Bem-vindo, {{ $participant->name }}!</h1>

                <!-- Mensagens de Sucesso ou Erro -->
                @if(session('success'))
                    <div class="bg-green-100 text-green-800 p-4 rounded-lg">
                        <p>{{ session('success') }}</p>
                    </div>
                @elseif(session('error'))
                    <div class="bg-red-100 text-red-800 p-4 rounded-lg">
                        <p>{{ session('error') }}</p>
                    </div>
                @endif

                @if($participant->password)
                    <!-- Exibição do Amigo Oculto após Verificação -->
                    @if(session('secret_friend'))
                        <div class="mt-6 bg-green-100 text-green-800 p-4 rounded-lg">
                            <p>Seu amigo oculto é: <span class="font-semibold">{{ session('secret_friend') }}</span></p>
                            @if(!empty($participant->amigoOculto->sugestao_de_presente))
                                <p class="text-gray-700">
                                    <strong>
                                        Essa é a sugestão de presente do seu amigo oculto {{$participant->amigoOculto->name}}: {{$participant->amigoOculto->sugestao_de_presente}}
                                    </strong>
                                </p>
                            @else
                                <p class="text-gray-700">Seu amigo oculto não possui sugestão de presente.</p>
                            @endif

                            <form action="{{ route('participants.store_suggestion', $participant->id) }}" method="POST" class="space-y-4">
                                @csrf
                                <label for="sugestao_de_presente" class="block text-gray-700 font-semibold">Descreva sua sugestão de presente:</label>
                                <textarea id="sugestao_de_presente" name="sugestao_de_presente" class="border rounded-lg p-2 w-full">{{ $participant->sugestao_de_presente }}</textarea>
                                <div class="flex justify-between items-center">
                                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition">Salvar</button>
                                    <a href="{{ route('groups.show', $participant->group->uuid) }}" class="text-blue-500 hover:text-blue-600 transition">Voltar</a>
                                </div>
                            </form>
                        </div>
                    @else
                        <!-- Formulário de Verificação de Senha -->
                        <form action="{{ route('participants.check_password', $participant->id) }}" method="POST" class="space-y-4">
                            @csrf
                            <label for="password" class="block text-gray-700 font-semibold">Digite sua senha para ver seu amigo oculto:</label>
                            <input type="password" id="password" name="password" class="border rounded-lg p-2 w-full" placeholder="Sua senha" required>
                            <div class="flex justify-between items-center">
                                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition">Entrar</button>
                                <a href="{{ route('groups.show', $participant->group->uuid) }}" class="text-blue-500 hover:text-blue-600 transition">Voltar</a>
                            </div>
                        </form>
                    @endif
                @else
                    <!-- Formulário de Criação de Senha -->
                    <p class="text-gray-700">Você é {{$participant->name}} ? caso não seja você <a href="{{ route('groups.show', $participant->group->uuid) }}" class="text-blue-500 hover:text-blue-600 transition">Clique Aqui!</a></p>
                    <form action="{{ route('participants.set_password', $participant->id) }}" method="POST" class="space-y-4">
                        @csrf
                        <label for="password" class="block text-gray-700 font-semibold">Crie uma senha para acessar seu amigo oculto {{$participant->name}} :</label>
                        <input type="password" id="password" name="password" class="border rounded-lg p-2 w-full" placeholder="Crie sua senha" required>
                        <div class="flex justify-between items-center">
                            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition">Criar Senha</button>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
