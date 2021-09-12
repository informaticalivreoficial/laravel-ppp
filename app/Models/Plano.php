<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Plano extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'status',
        'valor',
        'views',
        'content'
    ];

    /**
     * Scopes
     */
    public function scopeAvailable($query)
    {
        return $query->where('status', 1);
    }
    
    public function scopeUnavailable($query)
    {
        return $query->where('status', 0);
    } 
    
    public function perfisAvailable($filter = null)
    {
        $perfis = Perfil::whereNotIn('perfils.id', function($query) {
            $query->select('perfil_plano.perfil_id');
            $query->from('perfil_plano');
            $query->whereRaw("perfil_plano.plano_id={$this->id}");
        })
        ->where(function ($queryFilter) use ($filter) {
            if ($filter)
                $queryFilter->where('perfils.name', 'LIKE', "%{$filter}%");
        })
        ->paginate();

        return $perfis;
    }

    /**
     * Relacionamentos
     */
    public function details()
    {
        return $this->hasMany(DetailPlan::class,'plano', 'id');
    }
    //Get Perfis
    public function perfils()
    {
        return $this->belongsToMany(Perfil::class);
    }

     /**
     * Accerssors and Mutators
     */

    public function setValorAttribute($value)
    {
        $this->attributes['valor'] = (!empty($value) ? floatval($this->convertStringToDouble($value)) : null);
    }

    public function getValorAttribute($value)
    {
        if (empty($value)) {
            return null;
        }

        return number_format($value, 2, ',', '.');
    }

    public function setStatusAttribute($value)
    {
        $this->attributes['status'] = ($value == '1' ? 1 : 0);
    }

    public function setSlug()
    {
        if(!empty($this->name)){
            $plano = Plano::where('name', $this->name)->first(); 
            if(!empty($plano) && $plano->id != $this->id){
                $this->attributes['slug'] = Str::slug($this->name) . '-' . $this->id;
            }else{
                $this->attributes['slug'] = Str::slug($this->name);
            }            
            $this->save();
        }
    }

    private function convertStringToDouble($param)
    {
        if(empty($param)){
            return null;
        }
        return str_replace(',', '.', str_replace('.', '', $param));
    }
}
