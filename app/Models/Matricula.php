<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;

class Matricula extends Model
{
    use HasFactory;

    // Nome explícito da tabela (caso siga o padrão plural em português)
    protected $table = 'matriculas';

    // Campos permitidos para atribuição em massa
    protected $fillable = [
        'pessoa_id',
        'aula_id',
        'valor_pago',
        'data_pagamento',
        'data_inicio',
        'data_fim',
        'status',
        'observacoes',
    ];

    // Casts automáticos para conversão de tipos de dados
    protected $casts = [
        'data_inicio' => 'date',
        'data_fim' => 'date',
        'valor_pago' => 'decimal:2',
      ];

    /**
     * Relacionamento: Uma matrícula pertence a uma Pessoa (aluno).
     */
    public function pessoa()
    {
        return $this->belongsTo(Pessoa::class, 'pessoa_id');
    }

    public function aula()
    {
        return $this->belongsTo(Aula::class, 'aula_id');
    }

    /**
     * Query Scope: Retorna apenas matrículas ativas (status 'ativa' e dentro da validade).
     */
    public function scopeAtivas(Builder $query): void
    {
        $query->where('status', 'ativa')
              ->whereDate('data_inicio', '<=', now())
              ->whereDate('data_fim', '>=', now());
    }

    /**
     * Query Scope: Retorna matrículas vencidas ou com data fim expirada.
     */
    public function scopeVencidas(Builder $query): void
    {
        $query->where('status', 'vencida')
              ->orWhere('data_fim', '<', now());
    }
}