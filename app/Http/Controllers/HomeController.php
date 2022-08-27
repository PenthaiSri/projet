<?php

namespace app\Http\Controller;
use Illuminate\Routing\Controller as BaseController;

class HomeController extends BaseController {

    /**
     * Methode chargée par défaut et vérifie les droits d'accès
     * 
     * @since   1.2207
     * @version 1.0.0
     * 
     * @return  boolean
     */
    public function index()
    {
        // On vérifie si l'utilisateur est bien connecté

        // S'il n'est pas connecté, on renvoi sur la page de login
    }

    /**
     * Methode permettant d'afficher la méteo du jour
     * Fait appel à une API
     * 
     * @since   1.2207
     * @version 1.0.0
     * 
     * @return  boolean
     */
    public function showWeather()
    {

    }

    /**
     * Methode permettant d'afficher les messages d'activités des modules
     * 
     * @since   1.2207
     * @version 1.0.0
     * 
     * @return  boolean
     */
    public function showLogModule()
    {

    }

    /**
     * Methode permettant d'afficher l'états des modules actifs
     * 
     * @since   1.2207
     * @version 1.0.0
     * 
     * @return  boolean
     */
    public function showModuleState()
    {

    }
}