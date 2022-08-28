<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class SessionController extends BaseController
{

    /**
     * Vérifie si l'utilisateur est connecté
     * 
     * @since   1.2207
     * @version 1.0.0
     * 
     * @return boolean
     */
    public static function checkIfConnected()
    {
        // Si l'id de session est vide, on renvoi sur le page de connexion
        session_start();
        if (!isset($_SESSION['loggedin'])) {
            return redirect('login');
        }
    }

    /**
     * Vérifie si l'utilisateur à le droit d'accèss à cette page
     * 
     * @since   1.2207
     * @version 1.0.0
     * 
     * 
     * @return  boolean
     */
    public static function adminOnly()
    {
        /**
         * Si l'utilisateur ne possède pas les droits
         * On renvoi sur une page d'erreur 403
         */
        if (!isset($_SESSION['loggedin'])) {
            return redirect('login');
        } else {
            // Charge les classes nécessaires
            $oUserModel = new User();
            // Récupère l'id de l'utilisateur connecté
            $iUserId = $_SESSION['user_id'];
            // Récupère le rôle de l'utilisateur
            $aUserList = $oUserModel->getById($iUserId);
            $aUser = $aUserList[0];
            if ($aUser->role_id != User::ADMIN) {
                return back();
            }
        }
        if (!isset($_SESSION['role_id'])) {
            $_SESSION['role_id'] = $aUser->role_id;
        }
    }
}
