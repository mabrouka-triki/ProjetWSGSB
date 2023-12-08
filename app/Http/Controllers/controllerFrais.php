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

    public function addFicheFrais()
    {
        try {
            $json = file_get_contents('php://input');
            $fraisJson = json_decode($json);

            if ($fraisJson != null) {
                $anneeMois = $fraisJson->anneemois;
                $dateModification = $fraisJson->dateModification;
                $montantValide = $fraisJson->montantValide;
                $nbJustificatifs = $fraisJson->nbJustificatifs;
                $idVisiteur = $fraisJson->idVisiteur;
                $etat = $fraisJson->id_etat;

                $unService = new ServiceFrais($anneeMois, $dateModification, $montantValide, $nbJustificatifs, $idVisiteur, $etat);


                $response = "un frais est bien ajouté ";

                return response()->json($response);
            }
        } catch (MonException $e) {
            $erreur = $e->getMessage();
            return response()->json($erreur, 201);
        }
    }

}

