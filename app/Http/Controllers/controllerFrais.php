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
                $anneemois = $fraisJson->anneemois;
                $dateModification = $fraisJson->dateModification;
                $montantValide = $fraisJson->montantValide;
                $nbjustificatifs = $fraisJson->nbjustificatifs;
                $id_visiteur = $fraisJson->id_visiteur;
                $id_etat = $fraisJson->id_etat;

                $unService = new ServiceFrais();
                $uneReponse = $unService->insertFrais($anneemois, $dateModification, $montantValide, $nbjustificatifs, $id_visiteur, $id_etat);

                return response()->json($uneReponse);
            } else {
                return response()->json('Données manquantes', 400);
            }
        } catch (MonException $e) {
            $erreur = $e->getMessage();
            return response()->json($erreur, 201);
        }
    }

    public function updateFicheFrais()
    {
        try {
            $json = file_get_contents('php://input');
            $fraisJson = json_decode($json);

            if ($fraisJson != null) {
                $idfrais = $fraisJson->id_frais;
                $anneemois = $fraisJson->anneemois;
                $dateModification = $fraisJson->datemodification;  // Correction ici
                $montantValide = $fraisJson->montantvalide;  // Correction ici
                $nbjustificatifs = $fraisJson->nbjustificatifs;
                $id_visiteur = $fraisJson->id_visiteur;
                $id_etat = $fraisJson->etat->id_etat;

                $unService = new ServiceFrais();
                $uneReponse = $unService->updateFrais($idfrais, $anneemois, $dateModification, $montantValide, $nbjustificatifs, $id_visiteur, $id_etat);

                return response()->json($uneReponse);
            }
        } catch (MonException $e) {
            $erreur = $e->getMessage();
            return response()->json($erreur, 201);
        }
    }

    public function suppressionFrais($idfrais)
    {
        try {
            $unService = new ServiceFrais();
            $uneReponse = $unService->deleteFrais($idfrais);

            return response()->json($uneReponse);
        } catch (MonException $e) {
            $erreur = $e->getMessage();
            return response()->json($erreur, 201);
        }
    }

}
