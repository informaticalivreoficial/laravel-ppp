<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPlan extends Model
{
    use HasFactory;

    protected $table = 'plan_details';

    protected $fillable = ['name','plano'];

    /**
     * Scopes
     */
       

    /**
     * Relacionamentos
     */
    public function plan()
    {
        return $this->belongsTo(Plano::class,'id', 'plano');
    }

    /**
     * Accerssors and Mutators
     */
}
