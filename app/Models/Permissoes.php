<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permissoes extends Model
{
    use HasFactory;

    protected $table = 'permissoes';

    protected $fillable = [
        'name',
        'content'
    ];

    /**
     * Scopes
     */
       

    /**
     * Relacionamentos
     */
    public function perfil()
    {
        return $this->belongsToMany(Perfil::class);
    }

    /**
     * Accerssors and Mutators
     */
}
