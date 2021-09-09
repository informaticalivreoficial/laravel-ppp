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
        'valor',
        'content'
    ];

    /**
     * Scopes
     */

    /**
     * Relacionamentos
     */

     /**
     * Accerssors and Mutators
     */
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
}
