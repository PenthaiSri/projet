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
        $aEmailExist = $oUserModel->getByEmail($_POST['email']);
        if (isset($aEmailExist[0])) {
            return redirect('admin/create')->with('error-create', 'Cet email est déjà utilisé !');
            unset($_POST);
        }
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
            return redirect('admin/create')->with('error-create', 'Veuillez renseigner tous les champs !');
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
            return redirect('admin/create')->with('error-create', 'Erreur lors de la création du compte !');
        }
        unset($_POST);
        return redirect('admin/create')->with('success-create', 'Le compte à bien été crée !');
    }

    /**
     * Supprime un utilisateur de la base de données
     * 
     * @since   1.2207.0
     * @version 1.2207.0
     * 
     * @return  boolean
     */
    public function removeUser()
    {
        // Charge les classes nécessaires
        $oUserModel = new User();
        // Récupère l'id de l'utilisateur
        session_start();
        $iId = $_SESSION['usr_id'];
        // Prépare le requête SQL
        $bRequest = $oUserModel->remove($iId);
        if ($bRequest === false) {
            DB::rollBack();
            return false;
        }
        return redirect('admin/create');
    }

    /**
     * Modifie un utilisateur
     * 
     * @since   1.2207.0
     * @version 1.2207.0
     * 
     * @return  boolean
     */
    public function editUser()
    {
        // Charge les classes nécessaires
        $oUserModel = new User();
        // Récupère l'id de l'utilisateur
        session_start();
        $iId = $_SESSION['usr_id'];
        // Récupère les données saisies dans les champs
        if (!empty($_POST['lastname']) && !empty($_POST['firstname']) && !empty($_POST['email']) && !empty($_POST['phone'])) {
            $sLastname = $_POST['lastname'];
            $sFirstname = $_POST['firstname'];
            $sEmail = $_POST['email'];
            $iPhone = $_POST['phone'];
        }
        $sRole = $_POST['role'];
        $sFonction = $_POST['fonction'];
        // prépare la requête SQL
        $bRequest = $oUserModel->edit(
            $iId,
            $sLastname,
            $sFirstname,
            $sEmail,
            $iPhone,
            $sFonction,
            $sRole
        );
        if ($bRequest === false) {
            DB::rollBack();
            return false;
        }
        return redirect('admin/create');
    }
}