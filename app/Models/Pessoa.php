<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

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
        'eh_instrutor',
        'contato_emergencia',
        'saude',
        'responsavel_nome',
        'responsavel_parentesco',
        'responsavel_contato',
        'responsavel_documento',
    ];

    protected $casts = [
        'eh_instrutor' => 'boolean',
    ];

    public function scopeInstrutores(Builder $query): void
    {
        $query->where('eh_instrutor', true);
    }


    public function scopeAlunos(Builder $query): void
    {
        $query->where('eh_instrutor', false);
    }
}