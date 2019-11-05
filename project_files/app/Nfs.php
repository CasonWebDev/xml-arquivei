<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nfs extends Model
{

    protected $fillable = [
        'access_key',
        'total'
    ];

    // Obtem um registro do banco pelo access_key
    public static function getNf($access_key)
    {
        return self::where('access_key', $access_key)->first();
    }

    // Cria um novo registro no banco com base nos dados recebidos e o retorna para a API
    public static function setNf($data)
    {
        return Nfs::firstOrCreate($data);
    }
}
