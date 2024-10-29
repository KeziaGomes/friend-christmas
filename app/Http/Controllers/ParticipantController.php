<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ParticipantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Participant $participant)
    {

        return view('show-participant', ['participant' => $participant]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Define uma nova senha para o participante.
     */
    public function setPassword(Request $request, Participant $participant)
    {
        // Valida a entrada
        $request->validate([
            'password' => 'required|string|min:6',
        ]);

        // Define e salva a senha criptografada
        $participant->password = Hash::make($request->password);
        $participant->save();

        // Redireciona de volta com mensagem de sucesso
        return redirect()->back()->with('success', 'Senha criada com sucesso! Agora você pode acessar seu amigo oculto.');
    }

    /**
     * Verifica a senha do participante e exibe o amigo oculto se a senha estiver correta.
     */
    public function checkPassword(Request $request, Participant $participant)
    {
        // Valida a entrada
        $request->validate([
            'password' => 'required|string',
        ]);

        // Verifica a senha
        if (Hash::check($request->password, $participant->password)) {
            // Recupera o amigo secreto do participante (ajuste conforme o relacionamento)
            $secretFriend = $participant->amigoOculto->name ?? 'Nenhum amigo oculto encontrado';

            // Redireciona com o nome do amigo oculto
            return redirect()->back()->with([
                'secret_friend' => $secretFriend,
            ]);
        }

        // Redireciona de volta com mensagem de erro
        return redirect()->back()->with('error', 'Senha incorreta. Tente novamente.');
    }

    public function storeSuggestion(Request $request, Participant $participant)
    {
        // Valida a entrada
        $request->validate([
            'sugestao_de_presente' => 'required|string|min:6',
        ]);

        // Define e salva a senha criptografada
        $participant->sugestao_de_presente = $request->sugestao_de_presente;
        $participant->save();

        // Redireciona de volta com mensagem de sucesso
        return redirect()->back()->with('success', 'Sugestão de presente salva com sucesso!');

    }
}
