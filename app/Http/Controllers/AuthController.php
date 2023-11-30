<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Visiteur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Vérifiez si la requête est en JSON
        if ($request->isJson()) {
            $data = $request->json()->all();
            // Validation des données reçues, il faut un email et un password
            $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);
            // Correspondance pour la validation des données
            $credentials = ['email' => $data['email'], 'password' => $data['password']];
            // Auth valide que l'email et le password existe dans la table users
            if (!Auth::attempt($credentials)) {
                return response()->json(['error' => 'The provided credentials are incorrect.'], 401);
            }
            // on récupère les infos du user
            $user = User::where('email', $data['email'])->first();

            // Création et sauvegarde du token user
            $token = $user->createToken('auth_token')->plainTextToken;
            $user->remember_token = $token;
            $user->save();
            // On récupère le visiteur (même id que user)
            $visiteur = Visiteur::find($user->id);;
            // On retourne un JSON pour Angular
            return response()->json([
                'visiteur' => [
                    'id_visiteur' => $visiteur->id_visiteur,
                    'nom_visiteur' => $visiteur->nom_visiteur,
                    'prenom_visiteur' => $visiteur->prenom_visiteur,
                    'type_visiteur' => $visiteur->type_visiteur,
                ],
                'access_token' => $token,
                'token_type' => 'bearer',
            ]);
        }
        // Gestion des erreurs si la requête n'est pas en JSON
        return response()->json(['error' => 'Request must be JSON.'], 415);
    }
}
