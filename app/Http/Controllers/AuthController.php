<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class AuthController extends BaseController
{

    /**
     * Methode permettant d'enregistrer un utilisateur en BDD
     * 
     * @since   1.2205
     * @version 1.0.0
     * 
     * @return  boolean
     */
    public function register()
    {
        // On charge les models
        $oUserModel = new User();
        // On vérifie si l'email existe déjà
        // $bEmailExist = $oUserModel->checkIfExist($_POST['email']);
        // if ($bEmailExist == null) {
        //     unset($_POST);
        //     return view('auth/register');
        // }
        // si tous les champs sont complétés
        if (!empty($_POST['firstname']) && !empty($_POST['lastname']) && !empty($_POST['email']) && !empty($_POST['pwd'])) {
            $sFirstname = $_POST['firstname'];
            $sLastname = $_POST['lastname'];
            $sEmail = $_POST['email'];
            $sPassword = $_POST['pwd'];
            // On hash le mot de passe
            $sHashPwd = password_hash($sPassword, PASSWORD_DEFAULT);
            // Prépare la requête
            $oResult  = $oUserModel->register($sFirstname, $sLastname, $sEmail, $sHashPwd);
            // Si erreur lors de la requête
            if ($oResult === false) {
                DB::rollBack();
                return false;
            }
            return redirect('login');
        } else {
            return redirect('register');
        }
    }

    /**
     * Methode permettant à un utilisateur de se connecter
     * 
     * @since   1.2205
     * @version 1.0
     * 
     * @return  boolean
     */
    public function login()
    {
        // On charge les models
        $oUserModel = new User();
        // Si les champs sont renseignés
        if (!empty($_POST['email']) && !empty($_POST['pwd'])) {
            $sEmail = $_POST['email'];
            $sPwd = $_POST['pwd'];
            $aUserList = $oUserModel->getByEmail($sEmail);
            $aUser = $aUserList[0];
            if ($sEmail == $aUser->usr_email && password_verify($sPwd, $aUser->usr_password)) {
                /**
                 * On démarre une session
                 * et stock quelques données en variables de sessions
                 */
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['user_id'] = $aUser->usr_id;
                // On renvoie sur la page des relevés
                return redirect('list');
            } else {
                return redirect('login');
            }
        } else {
            return redirect('login');
        }
        unset($_POST);
    }

    /**
     * Methode permettant la réinitialisation du mot de passe
     * 
     * @version 1.0.0
     * @since   1.2206
     */
    public function forgotPassword()
    {
    }

    /**
     * Methode permettant de détruire la session
     * 
     * @since   1.2206
     * @version 1.0.0
     */
    public function stopSession()
    {
        // On détruit la session et vide le tableau
        session_start();
        session_destroy();
        // On renvoie sur la page de login
        return redirect('login');
    }
}
