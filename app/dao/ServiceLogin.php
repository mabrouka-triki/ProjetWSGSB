<?php

namespace App\dao;

use App\Exceptions\MonException;
use App\Models\Visiteur;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;


class ServiceLogin
{

    public function getConnexion($login_visiteur, $pwd_visiteur)
    {
        $response = null;

        try {
            if ($login_visiteur != null) {
                $visiteur = DB::table('visiteur')
                    ->where('login_visiteur', $login_visiteur)
                    ->first();

                if ($visiteur != null) {
                    if ($visiteur->pwd_visiteur == $pwd_visiteur) {
                        $response = $visiteur;
                    } else {
                        $response = array(
                            'status' => '401',
                            'message' => 'Authentification incorrecte'
                        );
                    }
                } else {
                    $response = array(
                        'status' => '401',
                        'message' => 'Authentification incorrecte'
                    );
                }
            } else {
                $response = array(
                    'status' => '401',
                    'message' => 'Authentification incorrecte'
                );
            }
        } catch (QueryException $e) {
            throw new MonException($e->getMessage());
        }

        return $response;
    }

    public function miseAjourMotPasse($pwd)
    {
        try {
            DB::table('visiteur')
                ->update(['pwd_visiteur' => $pwd,]);
        } catch (QueryException $e) {
            throw new MonException ($e->getMessage());
        }
    }
}

