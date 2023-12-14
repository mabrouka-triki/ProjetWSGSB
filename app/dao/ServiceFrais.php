<?php

namespace App\dao;

use App\Models\Frai;
use App\Exceptions\MonException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;


class ServiceFrais
{
    public function getFrais($id_visiteur)
    {
        try {
            $lesFrais = DB::table('frais')
                ->select()
                ->where('frais.id_visiteur', '=', $id_visiteur)
                ->get();
            return response()->json($lesFrais);
        } catch (QueryException $e) {

            throw new MonException($e->getMessage(), 5);
        }
    }

    public function insertFrais($anneemois, $dateModification, $montantValide, $nbjustificatifs, $id_visiteur, $id_etat)
    {
        try {
            DB::table('frais')->insert(
                [
                    'anneemois' => $anneemois,
                    'nbjustificatifs' => $nbjustificatifs,
                    'datemodification' => $dateModification,
                    'id_visiteur' => $id_visiteur,
                    'montantvalide' => $montantValide,
                    'id_etat' => $id_etat,
                ]
            );

            $response = array('status_message' => 'Insertion réalisée');

            return $response;
        } catch (QueryException $e) {
            throw new MonException($e->getMessage(), 5);
        }
    }

    public function updateFrais($idfrais, $anneemois, $dateModification, $montantValide, $nbjustificatifs, $id_visiteur, $id_etat)
    {
        try {
            DB::table('frais')
                ->where('id_frais', $idfrais)
                ->update([
                    'anneemois' => $anneemois,
                    'datemodification' => $dateModification,
                    'montantvalide' => $montantValide,
                    'nbjustificatifs' => $nbjustificatifs,
                    'id_visiteur' => $id_visiteur,
                    'id_etat' => $id_etat,
                ]);

            $response = array('status_message' => 'Modification réalisée');

            return $response;
        } catch (QueryException $e) {
            throw new MonException($e->getMessage(), 5);
        }
    }
    public function deleteFrais($idfrais)
    {
        try {
            DB::table('frais')
                ->where('id_frais', $idfrais)
                ->delete();

            $response = array('status_message' => 'Suppression réalisée');

            return $response;
        } catch (QueryException $e) {
            throw new MonException($e->getMessage(), 5);
        }
    }

}



