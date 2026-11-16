<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aula extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'descricao',
        'horario',
        'capacidade_maxima',
        'instrutor_id',
    ];

    public function users(){
        return $this->belongsToMany(User::class);
    }

    /**
     * Relacionamento: Uma aula pertence a um instrutor (que é uma Pessoa).
     */
    public function instrutor()
    {
        return $this->belongsTo(Pessoa::class, 'instrutor_id');
    }

    /**
     * Relacionamento: Uma aula possui muitas matrículas.
     */
    public function matriculas()
    {
        return $this->hasMany(Matricula::class, 'aula_id');
    }
}
