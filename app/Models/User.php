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
     * @return  array|boolean
     */
    public function allUsers()
    {
        $bRequest = DB::table('t_users')->select('*')->get();
        return $bRequest;
    }

    /**
     * Methode permettant de récupérer tous les utilisateurs
     * 
     * @since   1.2207.0
     * @version 1.2207.0
     * 
     * @return  array|boolean
     */
    public function getAll()
    {
        $sRequest = DB::select('SELECT * FROM t_users USR
        LEFT JOIN tr_roles TRS ON USR.role_id = TRS.role_id
        LEFT JOIN tr_fonctions TFS ON USR.ftn_id = TFS.ftn_id');

        return $sRequest;
    }


    /**
     * Methode permettant de récupérer un utilisateur par son email
     * 
     * @since   1.2206
     * @version 1.0.0
     * 
     * @param   $sEmail         Email de l'utilisateur
     * 
     * @return  array
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
     * @return  array|boolean
     */
    public function getById($iId)
    {
        $bRequest = DB::table('t_users')->select(
            'role_id',
            'ftn_id',
            'usr_firstname',
            'usr_lastname',
            'usr_email',
            'usr_phone'

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
     * @return  array|boolean
     */
    public function checkIfExist($sEmail)
    {
        $bRequest = DB::table('t_users')->select('usr_email')->where('usr_email', '=', $sEmail)->get();
        return $bRequest;
    }

    /**
     * Permet de supprimer un utilisateur de la base de données
     * 
     * @since   1.2207.0
     * @version 1.2207.0
     * 
     * @param   integer $iId    Identifiant de l'utilisateur
     * 
     * @return  boolean
     */
    public function remove($iId)
    {
        $sRequest = DB::table('t_users')->where('usr_id', '=', $iId)->delete();
        return $sRequest;
    }

    /**
     * Permet de modifier un utilisateur en base de données
     * 
     * @since   1.2207.0
     * @version 1.2207.0
     * 
     * @param   integer $iId        Identifiant de l'utilisateur
     * @param   string  $sLastname  Nom de l'utilisateur
     * @param   string  $sFirstname Prénom de l'utilisateur
     * @param   string  $sEmail     Email de l'utilisateur
     * @param   integer $iPhone     Numéro de téléphone de l'utilisateur
     * @param   integer $iFonction  Fonction de l'utilisateur
     * @param   integer $iRole      Role de l'utilisateur
     * 
     * @return  boolean
     */
    public function edit(
        $iId,
        $sLastname,
        $sFirstname,
        $sEmail,
        $iPhone,
        $iFonction,
        $iRole
    )
    {
        $sRequest = DB::table('t_users')->where('usr_id', '=', $iId)->update([
            'usr_firstname' => $sFirstname,
            'usr_lastname' => $sLastname,
            'usr_email' => $sEmail,
            'usr_phone' => $iPhone,
            'ftn_id' => $iFonction,
            'role_id' => $iRole
        ]);
        return $sRequest;
    }
}
