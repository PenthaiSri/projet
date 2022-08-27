<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class User {
    
    protected $table = 't_users';

    /**
     * Methode permettant de récupérer tous les utilisateurs
     * 
     * @since   1.2206
     * @version 1.0.0
     * 
     */
    public function allUsers()
    {
        $bRequest = DB::table('t_users')->get();
        return $bRequest;
    }


    /**
     * Methode permettant de récupérer un utilisateur par son email
     * 
     * @since   1.2206
     * @version 1.0.0
     * 
     * @param   $sEmail         Email de l'utilisateur
     * 
     * @return  boolean
     */
    public function getByEmail($sEmail)
    {
        $bRequest = DB::table('t_users')->select('usr_id', 'usr_firstname', 'usr_lastname', 'usr_email', 'usr_password')->where('usr_email', '=', $sEmail)->get();
        return $bRequest;
    }

    /**
     * Permet d'enregistrer un utilisateur en base de données
     * 
     * @since   1.2206
     * @version 1.0.0
     * 
     * @param   $sFirstname     Prénom de l'utilisateur
     * @param   $sLastname      Nom de l'utilisateur
     * @param   $sEmail         Email de l'utilisateur
     * @param   $sPassword      Mot de passe hashé de l'utilisateur
     * 
     * @return  boolean
     */
    public function register($sFirstname, $sLastname, $sEmail, $sPassword)
    {
        $bRequest = DB::table('t_users')->insert([
            'usr_firstname' => $sFirstname,
            'usr_lastname' => $sLastname,
            'usr_email' => $sEmail,
            'usr_password' => $sPassword,
            'log_created_at' => Carbon::now()->timezone('Europe/Paris')
        ]);
        return $bRequest;
    }

    /**
     * Récupère un user depuis son id
     * 
     * @since   1.2206
     * @version 1.2206
     * 
     * @param   $iId            Id de l'utilisateur
     * 
     * @return  boolean
     */
    public function getById($iId)
    {
        
    }

    /**
     * Vérifie si ce mail est déjà enregistré en base de données
     * 
     * @since   1.2207
     * @version 1.0.0
     * 
     * @param   $sEmail         Email de l'utilisateur
     * 
     * @return  boolean
     */
    public function checkIfExist($sEmail)
    {
        $bRequest = DB::table('t_users')->select('usr_email')->where('usr_email', '=', $sEmail)->get();
        return $bRequest;
    }
}
