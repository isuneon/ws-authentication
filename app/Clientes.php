<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Clientes extends Model
{
    use SoftDeletes;
    protected $table = 'clientes';



    protected $fillable = [
        'co_cli',
        'co_vendedor',
        'co_zona',
        'co_segmento',
        'tipo',
        'rif',
        'activo',
        'email',
        'descripcion',
        'direccion',
        'direc_entre',
        'telefono',
        'created_user',
        'update_user',
    ];

     /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at','created_at','updated_at'];




    

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['id'];



}
