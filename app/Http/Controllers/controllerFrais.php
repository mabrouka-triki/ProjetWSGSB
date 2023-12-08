<?php

namespace App\Http\Controllers;

use App\dao\ServiceFrais;
use App\Exceptions\MonException;
use Illuminate\Support\Facades\Session;

class controllerFrais
{
    public function getListeFicheFrais($id_visiteur)
    {
        try {

            $unService = new ServiceFrais();
            $response = $unService->getFrais($id_visiteur);
            return response()->json($response);

        } catch (MonException $e) {
            $erreur = $e->getMessage();
            return response()->json($erreur, 204);
        }
    }
}

