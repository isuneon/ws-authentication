<?php

namespace App;
use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
    
    //  //establecemos las relaciones con el modelo Role, ya que un usuario puede tener varios roles
    // //y un rol lo pueden tener varios usuarios
    // public function permission_role(){
    //     return $this->belongsToMany('App\Permission');
    // }

    //establecemos las relaciones con el modelo Role, ya que un usuario puede tener varios roles
    //y un rol lo pueden tener varios usuarios
    public function permissions(){
        return $this->belongsToMany('App\Permission');
    }
}
