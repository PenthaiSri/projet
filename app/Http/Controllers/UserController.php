<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class UserController extends BaseController 
{
    /**
     * Ajoute un utilisateur en base de données
     * 
     * @since   1.2207.0
     * @version 1.2207.0
     * 
     * @return  boolean
     */
    public function addUser()
    {
        // charge les classes nécessaires
        $oUserModel = new User();
        // Récupère les données envoyées en POST
        if (isset($_POST['lastname']) && isset($_POST['firstname']) && isset($_POST['email']) && isset($_POST['phone'])) {
            $sLastname = $_POST['lastname'];
            $sFirstname = $_POST['firstname'];
            $sEmail = $_POST['email'];
            $iPhone = $_POST['phone'];
            $iFonction = $_POST['fonction'];
            $iRole = $_POST['role'];
            // On défini un mot de passe par défaut
            $sPassword = password_hash('password', PASSWORD_DEFAULT);
        } else {
            return redirect('admin/create');
            unset($_POST);
        }
        // On prépare la requête SQL
        $bRequest = $oUserModel->addUser(
            $iRole,
            $iFonction,
            $sFirstname,
            $sLastname,
            $sEmail,
            $iPhone,
            $sPassword
        );
        if ($bRequest === false) {
            DB::rollBack();
            unset($_POST);
            return redirect('admin/create');
        }
        unset($_POST);
        return redirect('admin/create');
    }

    /**
     * Tableau de la liste des utilisateus
     * 
     * @since   1.2207.0
     * @version 1.2207.0
     * 
     * @return  boolean
     */
    public function showUser()
    {
        // Charge les classes nécessaires
        $oUserModel = new User();
    }
}