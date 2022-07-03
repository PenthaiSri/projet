<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;

class User {
    
    protected $table = 't_users';

    /**
     * Methode login
     * 
     * Permet à un utilisateur de se connecter à l'application grace à son code identifiant
     * 
     * @since   1.2205
     * @version 1.0
     * 
     * @return  bool True s'il n'y a pas d'erreurs, sinon false
     */
    public function login($code){
        DB::select("SELECT * FROM t_users USR
        WHERE USR.usr_code = " . $code . ";");
    }
}
