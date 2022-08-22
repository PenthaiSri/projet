<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class User {
    
    const ADMIN = 1;
    const EMPLOYE = 2;
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
        $bRequest = DB::table('t_users')->select('usr_id', 'role_id', 'usr_firstname', 'usr_lastname', 'usr_email', 'usr_password')->where('usr_email', '=', $sEmail)->get();
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
     * Permet d'enregistrer un utilisateur en base de données
     * 
     * @since   1.2206
     * @version 1.0.0
     * 
     * @param   $iRole          ID du role
     * @param   $iFonction      ID de sa fonction
     * @param   $sFirstname     Prénom de l'utilisateur
     * @param   $sLastname      Nom de l'utilisateur
     * @param   $sEmail         Email de l'utilisateur
     * @param   $iPhone         Numéro de téléphone
     * @param   $sPassword      Mot de passe hashé de l'utilisateur
     * 
     * @return  boolean
     */
    public function addUser($iRole, $iFonction, $sFirstname, $sLastname, $sEmail, $iPhone, $sPassword)
    {
        $bRequest = DB::table('t_users')->insert([
            'role_id' => $iRole,
            'ftn_id' => $iFonction,
            'usr_firstname' => $sFirstname,
            'usr_lastname' => $sLastname,
            'usr_email' => $sEmail,
            'usr_phone' => $iPhone,
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
        $bRequest = DB::table('t_users')->select(
            'role_id',
            'ftn_id',
            'usr_firstname',
            'usr_lastname',
            'usr_email'

        )->where('usr_id', '=', $iId)->get();
        return $bRequest;
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
