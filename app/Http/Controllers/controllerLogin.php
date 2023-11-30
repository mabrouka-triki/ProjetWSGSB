<?php

namespace App\Http\Controllers;

use App\dao\ServiceLogin;
use App\Exceptions\MonException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\dao\ServiceFrais;

class ControllerLogin
{

    public function signIn(Request $request)
    {
        try {
            if ($request->isJson()) {
                $data = $request->json()->all();
                $login_visiteur = $data['login_visiteur'];
                $pwd_visiteur = $data['pwd_visiteur'];
                $unService = new ServiceLogin();
                $visiteur = $unService->getConnexion($login_visiteur, $pwd_visiteur);
                return json_encode($visiteur);

            } else {
                $response = array(
                    'status' => '415',
                    'message' => 'La requete doit etre de type JSON'
                );
                return json_encode($response);  // Ajoutez un point-virgule ici
            }
        } catch (MonException $e) {
            $erreur = $e->getMessage();
            return response()->json($erreur);  // Corrigez cette ligne
        }
    }


    public function updatePassword($pwd)
    {
        $newpwd = Hash::make($pwd);
        try {
            $unLogin = new ServiceLogin();
            $unLogin->miseAjourMotPasse($newpwd);
        return view('home');
        } catch (MonException $e) {
            $erreur = $e->getMessage();
            return view('Error', compact('erreur'));
        } catch (Exception $e) {
            $erreur = $e->getMessage();
            return view('Error', compact('erreur'));
        }

    }
}
