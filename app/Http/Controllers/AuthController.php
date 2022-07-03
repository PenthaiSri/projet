<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Routing\Controller as BaseController;
use Symfony\Component\VarDumper\VarDumper;

class AuthController extends BaseController {

    /** 
     * Methode index
     * 
     * Methode chargée par défaut lorsque que le controller est appelé
     * 
     * @since   1.2205
     * @version 1.0
     */
    public function index()
    {

    }

    /**
     * Methode register
     * 
     * Methode permettant d'enregistrer un utilisateur en BDD
     * 
     * @since   1.2205
     * @version 1.0
     * 
     * @return  bool True s'il n'y a pas d'erreurs, sinon false
     */
    public function register()
    {

    }

    /**
     * Methode login
     * 
     * Methode permettant à un utilisateur de se connecter
     * 
     * @since   1.2205
     * @version 1.0
     * 
     * @return  bool True s'il n'y a pas d'erreurs, sinon false
     */
    public function login()
    {
        // On charge les models
        $oUserModel = new User();
        if(!empty($_POST['code']) && !empty($_POST['pwd'])) {
            $iCode = $_POST['code'];
            $iPwd = $_POST['pwd'];
            $sHashPwd = password_hash($iPwd, PASSWORD_DEFAULT);
            $aUser = $oUserModel->login($iCode);
            var_dump($aUser);
            exit();
            if($iCode == $aUser['code'] && $sHashPwd == $aUser['usr_pwd']) {
                return view('/list/index');
            } else {
                return view('/auth/login');
            }
        } else {
            return view('/auth/login');
        }
    }

}