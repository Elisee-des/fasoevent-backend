<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class City extends Model
{
    // Désactive l’auto-incrémentation pour utiliser UUID
    public $incrementing = false;
    // Spécifie que la clé primaire est un string (UUID)
    protected $keyType = 'string';
    // Champs remplissables
    protected $fillable = ['name'];

    // Génère automatiquement un UUID pour chaque nouvelle ville
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->id = Str::uuid();
        });
    }

    // Relation one-to-many avec les événements
    public function events()
    {
        return $this->hasMany(Event::class);
    }
}
