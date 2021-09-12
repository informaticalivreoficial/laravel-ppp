<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    use HasFactory;

    protected $table = 'perfils';

    protected $fillable = [
        'name',
        'content'
    ];

    /**
     * Scopes
     */
    public function permissionsAvailable($filter = null)
    {
        $permissions = Permissoes::whereNotIn('permissoes.id', function($query) {
            $query->select('perfil_permissoes.permissoes_id');
            $query->from('perfil_permissoes');
            $query->whereRaw("perfil_permissoes.perfil_id={$this->id}");
        })
        ->where(function ($queryFilter) use ($filter) {
            if ($filter)
                $queryFilter->where('permissoes.name', 'LIKE', "%{$filter}%");
        })
        ->paginate();

        return $permissions;
    }   

    /**
     * Relacionamentos
     */
    public function permissoes()
    {
        return $this->belongsToMany(Permissoes::class);
    }

    /**
     * Accerssors and Mutators
     */
}
