<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Locadora extends Model
{
    // Adiciona os campos que podem ser atribuídos em massa
    protected $fillable = ['nome', 'cnpj', 'url_api'];

    // Proteger todos os campos exceto os especificados
    protected $guarded = [];
}
