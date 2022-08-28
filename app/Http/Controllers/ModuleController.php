<?php

namespace App\Http\Controllers;

use App\Models\Module;
use Egulias\EmailValidator\Result\Reason\EmptyReason;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class ModuleController extends BaseController {

    /**
     * Methode showModule
     * 
     * Methode permettant de renvoyer sur la page détaillée des modules
     * 
     * @since   1.2205
     * @version 1.0
     * 
     * @return  bool Retourne true s'il n'y a pas d'erreurs, sinon false
     */
    public function showModule()
    {
        // Charge les classes nécessaires
        $oModuleModel = new Module();
    }

    /**
     * Methode createModule
     * 
     * Methode permettat de créer un module et l'enregistrer en BDD
     * 
     * @since   1.2206
     * @version 1.0
     * 
     * @return  bool Retourne true s'il n'y a pas d'erreurs, sinon false
     */
    public function createModule()
    {
        // Charge les classes nécessaires
        $oModuleModel = new Module();
        // Récupère les informations saisies dans le formulaire
        // Si le champ name n'est pas vide
        if (!empty($_POST['name'])) {
            $sModName = $_POST['name'];
        }
        // Si le champ locate n'est pas vide
        if (!empty($_POST['locate'])) {
            $sLocate = $_POST['locate'];
        } else {
            $sLocate = '';
        }
        // Si le champ description n'est pas vide
        if (!empty($_POST['description'])) {
            $sDesc = $_POST['description'];
        } else {
            $sDesc = '';
        }
        // Si le champ humidité du sol n'est pas vide
        if (!empty($_POST['gr-humidity'])) {
            $fGroundHum = $_POST['gr-humidity'];
        }
        // Si le champ humidité min du sol n'est pas vide
        if (!empty($_POST['min-humidity'])) {
            $fMinHum = $_POST['min-humidity'];
        }
        // Si le champ humidité max du sol n'est pas vide
        if (!empty($_POST['max-humidity'])) {
            $fMaxHum = $_POST['max-humidity'];
        }
        // Si le champ température min n'est pas vide
        if (!empty($_POST['min-temp'])) {
            $fMinTemp = $_POST['min-temp'];
        } else {
            $fMinTemp = null;
        }
        // Si le champ température max n'est pas vide
        if (!empty($_POST['max-temp'])) {
            $fMaxTemp = $_POST['max-temp'];
        } else {
            $fMaxTemp = null;
        }
        // Si le champ humidité min de l'air n'est pas vide
        if (!empty($_POST['min-air'])) {
            $fMinAir = $_POST['min-air'];
        } else {
            $fMinAir = null;
        }
        // Si le champ humidité min de l'air n'est pas vide
        if (!empty($_POST['max-air'])) {
            $fMaxAir = $_POST['max-air'];
        } else {
            $fMaxAir = null;
        }
        // Prépare l'enregistrement en base de données
        $bRequest = $oModuleModel->create(
            $sModName,
            $sLocate,
            $sDesc,
            $fGroundHum,
            $fMinHum,
            $fMaxHum,
            $fMinTemp,
            $fMaxTemp,
            $fMinAir,
            $fMaxAir
        );
        // Si erreurs, annule la transaction et renvoie un message d'erreur
        if ($bRequest === false) {
            DB::rollBack();
            return redirect('list/create');
            return false;
        }
        unset($_POST);
        return redirect('list');
        return true;
    }

    /**
     * Methode removeModule
     * 
     * Methode permettant de retirer un module de la liste et de la BDD
     * 
     * @since   1.2205
     * @version 1.0
     * 
     * @return  bool Retourne true s'il n'y pas d'erreurs, sinon false
     */
    public function removeModule()
    {
        session_start();
        // Charge les classes nécessaires
        $oModuleModel = new Module();
        // Récupère l'id
        $iId = $_SESSION['mde_id'];
        $bRequest = $oModuleModel->remove($iId);
        if ($bRequest === false) {
            DB::rollBack();
            return false;
        }
        unset($_SESSION['mde_id']);
        return redirect('list');
        return true;
    }

    /**
     * Methode modifyModule
     * 
     * Methode permettant la modification d'un module présent dans la liste et en BDD
     * 
     * @since   1.2205
     * @version 1.0
     * 
     * @return  bool Retoure true s'il n'y a pas d'erreurs, sinon false
     */
    public function modifyModule()
    {
        // récupère l'id du module
        session_start();
        $iId = $_SESSION['mde_id'];
        // Charge les classes nécessaires
        $oModuleModel = new Module();

        // Récupère les données du formulaire
        if (!empty($_POST['name']) && !empty($_POST['gr-humidity'])
        && !empty($_POST['min-humidity']) && !empty($_POST['max-humidity'])) {
            $sName = $_POST['name'];
            $fGroundHum = $_POST['gr-humidity'];
            $fMinHum = $_POST['min-humidity'];
            $fMaxHum = $_POST['max-humidity'];
        }

        if (!empty($_POST['locate'])) {
            $sLocate = $_POST['locate'];
        } else { $sLocate = null; }

        if (!empty($_POST['description'])) {
            $sDesc = $_POST['description'];
        } else { $sDesc = null; }

        if (!empty($_POST['min-temp'])) {
            $fMinTemp = $_POST['min-temp'];
        } else { $fMinTemp = null; }

        if (!empty($_POST['max-temp'])) {
            $fMaxTemp = $_POST['max-temp'];
        } else { $fMaxTemp = null; }

        if (!empty($_POST['min-temp'])) {
            $fMinTemp = $_POST['min-temp'];
        } else { $fMinTemp = null; }

        if (!empty($_POST['min-air'])) {
            $fMinAir = $_POST['min-air'];
        } else { $fMinAir = null; }

        if (!empty($_POST['max-air'])) {
            $fMaxAir = $_POST['max-air'];
        } else { $fMaxAir = null; }

        // Prépare la requête SQL
        $bRequest = $oModuleModel->modify(
            $iId,
            $sName,
            $sLocate,
            $sDesc,
            $fGroundHum,
            $fMinHum,
            $fMaxHum,
            $fMinTemp,
            $fMaxTemp,
            $fMinAir,
            $fMaxAir
        );
        if ($bRequest === false) {
            DB::rollBack();
            unset($_SESSION['mde_id']);
        }
        unset($_POST);
        unset($_SESSION['mde_id']);
        return redirect('list');
        return true;
    }
}