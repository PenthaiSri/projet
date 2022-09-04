<?php

namespace app\Models;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Module
{
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
     * @param   $fMinHum        Float   Required        Taux minimum d'humidité dans le sol
     * @param   $fMaxHum        Float   Required        Taux maximum d'humidité dans le sol
     * 
     * @return  bool Retourne true s'il n'y a pas d'erreurs, sinon false
     */
    public function create(
        $sName,
        $sLocate,
        $sDesc,
        $fMinHum,
        $fMaxHum,
    ) {
        $bRequest = DB::table('t_modules')->insert([
            'plant_name' => $sName,
            'mde_locate' => $sLocate,
            'mde_description' => $sDesc,
            'mde_min_soil' => $fMinHum,
            'mde_max_soil' => $fMaxHum,
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
     * @param   $iId            Integer Required        Id du module
     * 
     * @return  bool Retourne true s'il n'y a pas d'erreurs, sinon false
     */
    public function remove($iId)
    {
        $sRequest = DB::table('t_modules')->where('mde_id', '=', $iId)->delete();
        return $sRequest;
    }

    /**
     * Permet de modifier un module en base de données
     * 
     * @since   1.2206.0
     * @version 1.2207.0
     * 
     * @param   $iId            Integer Required        Id du module
     * @param   $sName          String  Required        Nom donné au module
     * @param   $sLocate        String  Not Required    Emplacement du module
     * @param   $sDesc          String  Not Required    Description du module
     * @param   $fMinHum        Float   Required        Taux minimum d'humidité dans le sol
     * @param   $fMaxHum        Float   Required        Taux maximum d'humidité dans le sol
     * 
     * @return  bool Retourne true s'il n'y a pas d'erreurs, sinon false
     */
    public function modify(
        $iId,
        $sName,
        $sLocate,
        $sDesc,
        $fMinHum,
        $fMaxHum,
    ) {
        $sRequest = DB::table('t_modules')->where('mde_id', '=', $iId)->update([
            'ste_id' => 1,
            'plant_name' => $sName,
            'mde_locate' => $sLocate,
            'mde_description' => $sDesc,
            'mde_min_soil' => $fMinHum,
            'mde_max_soil' => $fMaxHum
        ]);
        return $sRequest;
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
     * @return  array|boolean 
     */
    public function getById($iId)
    {
        $sRequest = DB::table('t_modules')->select('*')->where('mde_id', '=', $iId)->get();
        return $sRequest;
    }

    /**
     * Récupère tous les modules enregistrées
     * 
     * @since   1.2207.0
     * @version 1.2207.0
     * 
     * @return  array
     */
    public function getAll()
    {
        $sRequest = DB::select('SELECT * FROM t_modules MDE
        LEFT JOIN tr_states STE ON MDE.ste_id = STE.ste_id');
        return $sRequest;
    }

    /**
     * Récupère le dernier relevé de température par id du module
     * 
     * @since   1.2207.0
     * @version 1.2207.0
     * 
     * @param   integer $mde_id ID du Module
     * 
     * @return  array|boolean
     */
    public function getTemperatureByModId($mde_id){
        $sRequest = DB::select('SELECT * FROM t_readings RDG
        LEFT JOIN tr_arduino_sensors ARS ON RDG.ars_id = ARS.ars_id
        LEFT JOIN t_modules MDE ON ARS.mde_id = MDE.mde_id
        WHERE ARS.ars_name = "Temperature"
        AND MDE.mde_id = '. $mde_id .'
        ORDER BY RDG.rdg_datetime DESC
        LIMIT 1
        ');
        return $sRequest;
    }

    /**
     * Récupère le dernier relevé d'hygrométrie par id du module
     * 
     * @since   1.2207.0
     * @version 1.2207.0
     * 
     * @param   integer $mde_id ID du module
     * 
     * @return  array|boolean
     */
    public function getHygroByModId($mde_id){
        $sRequest = DB::select('SELECT * FROM t_readings RDG
        LEFT JOIN tr_arduino_sensors ARS ON RDG.ars_id = ARS.ars_id
        LEFT JOIN t_modules MDE ON ARS.mde_id = MDE.mde_id
        WHERE ARS.ars_name = "Hygrometrie"
        AND ARS.mde_id = '. $mde_id .'
        ORDER BY RDG.rdg_datetime DESC
        LIMIT 1
        ');
        return $sRequest;
    }

    /**
     * Récupère le dernier relevé d'humidité du sol par id du module
     * 
     * @since   1.2207.0
     * @version 1.2207.0
     * 
     * @param   integer $mde_id ID du module
     * 
     * @return  array|boolean
     */
    public function getSolByModId($mde_id){
        $sRequest = DB::select('SELECT * FROM t_readings RDG
        LEFT JOIN tr_arduino_sensors ARS ON RDG.ars_id = ARS.ars_id
        LEFT JOIN t_modules MDE ON ARS.mde_id = MDE.mde_id
        WHERE ARS.ars_name = "Sol"
        AND MDE.mde_id = '. $mde_id .'
        ORDER BY RDG.rdg_datetime DESC
        LIMIT 1
        ');
        return $sRequest;
    }
}
