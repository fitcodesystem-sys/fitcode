<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pessoa extends Model
{
    protected $fillable = [
        'nome',
        'cpf',
        'rg',
        'genero',
        'profissao',
        'nascimento',
        'email',
        'contato_emergencia',
        'saude',
        'responsavel_nome',
        'responsavel_parentesco',
        'responsavel_contato',
        'responsavel_documento',
    ];
}