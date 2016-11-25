<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    protected $connection = 'remote';

    protected $table = 'proveedores';

    protected $fillable = ['nombre'];

    public static function getProveedores()
    {
        return Proveedor::
            join('db2.users','proveedores.id','db2.users.proveedor_id')
            ->get();
    }
}
