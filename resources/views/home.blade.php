<x-app-layout>
    <div class="pt-4 bg-gray-100">
        {{-- @livewire('create-group') --}}

        <section class="py-16 sm:py-24">
            <div class="mx-auto max-w-7xl">
               <div class="lg:grid lg:grid-cols-12 lg:gap-8">
                  <div class="px-4 text-center sm:px-6 md:mx-auto md:max-w-2xl lg:col-span-6 lg:flex lg:items-center lg:text-left">
                     <div>
                        <h1 class="mt-4 text-4xl font-bold tracking-tight text-blue-600 sm:text-5xl md:text-6xl">Seu Amigo Secreto com Facilidade!
                        </h1>
                        <p class="mt-3 text-base text-gray-600 sm:mt-5 sm:text-xl lg:text-lg xl:text-xl">Torne seu amigo secreto uma experiência divertida e descomplicada! Com nossa plataforma, você pode organizar o sorteio em minutos, tudo pelo WhatsApp, sem precisar se cadastrar.
                        </p>
                        <p class="mt-3 text-base text-gray-600 sm:mt-5 sm:text-xl lg:text-lg xl:text-xl">
                            Basta preencher o formulário ao lado e comece a diversão! Nosso site é otimizado para dispositivos móveis, então você pode usar diretamente do seu celular!
                        </p>

                     </div>
                  </div>
                  <div class="px-4 mt-16 sm:mt-24 sm:px-0 lg:col-span-6 lg:mt-0">
                     <div class="bg-white border border-gray-300 rounded-lg sm:mx-auto sm:w-full sm:max-w-md sm:overflow-hidden">
                        <div class="pt-4 bg-gray-100">
                            @livewire('create-group')
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
    </div>
</x-app-layout>
