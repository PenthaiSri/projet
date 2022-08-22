<?php

namespace app\Models;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Module {
    protected $sTable = 't_modules';

    /**
     * Methode create
     * 
     * Permet d'enregistrer un module en base de données
     * 
     * @since   1.2206
     * @version 1.0
     * 
     * @param   $sName          String  Required        Nom donné au module
     * @param   $sLocate        String  Not Required    Emplacement du module
     * @param   $sDesc          String  Not Required    Description du module
     * @param   $fGroundHum     Float   Required        Taux optimale d'humidité dans le sol
     * @param   $fMinHum        Float   Required        Taux minimum d'humidité dans le sol
     * @param   $fMaxHum        Float   Required        Taux maximum d'humidité dans le sol
     * @param   $fMinTemp       Float   Not Required    Température minimum de l'air
     * @param   $fMaxTemp       Float   Not Required    Température maximum de l'air
     * @param   $fMinAir        Float   Not Required    Humidité minimum de l'air
     * @param   $fMaxAir        Float   Not Required    Humidité maximum de l'air
     * 
     * @return  bool Retourne true s'il n'y a pas d'erreurs, sinon false
     */
    public function create(
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
    ){
        $bRequest = DB::table('t_modules')->insert([
            'plant_name' => $sName,
            'mde_locate' => $sLocate,
            'mde_description' => $sDesc,
            'mde_ground_humidity' => $fGroundHum,
            'mde_min_soil' => $fMinHum,
            'mde_max_soil' => $fMaxHum,
            'mde_min_temp' => $fMinTemp,
            'mde_max_temp' => $fMaxTemp,
            'mde_min_air' => $fMinAir,
            'mde_max_air' => $fMaxAir,
            'log_created_at' => Carbon::now()->timezone('Europe/Paris')
        ]);
        return $bRequest;
    }

    /**
     * Methode remove
     * 
     * Permet de supprimer un module de la base de données
     * 
     * @since   1.2206
     * @version 1.0
     * 
     * @return  bool Retourne true s'il n'y a pas d'erreurs, sinon false
     */
    public function remove($id){

    }

    /**
     * Methode modify
     * 
     * Permet de modifier un module en base de données
     * 
     * @since   1.2206
     * @version 1.0
     * 
     * @return  bool Retourne true s'il n'y a pas d'erreurs, sinon false
     */
    public function modify($id){

    }

    /**
     * Methode getById
     * 
     * Récupère toutes les données d'un module à partir de son ID
     * 
     * @since   1.2206
     * @version 1.0
     * 
     * @param   integer             $iId    Id du module
     * 
     * @return  bool Retourne true s'il n'y a pas d'erreurs, sinon false
     */
    public function getById($iId){
        $sRequest = DB::table('t_modules')->select('*')->where('mde_id', '=', $iId)->get();
        return $sRequest;
    }
}