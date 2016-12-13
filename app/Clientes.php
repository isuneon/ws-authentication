<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{
    protected $table = 'clientes';

    protected $primaryKey = 'co_cli';

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
        'created_at',
        'updated_at',
        'deleted_at'
    ];




    

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['id'];



}
