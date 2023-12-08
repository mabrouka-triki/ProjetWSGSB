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

}
