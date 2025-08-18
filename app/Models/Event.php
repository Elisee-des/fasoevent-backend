<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Event extends Model
{
    // Désactive l’auto-incrémentation pour utiliser UUID
    public $incrementing = false;
    // Spécifie que la clé primaire est un string (UUID)
    protected $keyType = 'string';
    // Champs remplissables
    protected $fillable = ['title', 'description', 'start_date', 'end_date', 'city_id', 'price', 'image', 'is_active'];

    // Génère automatiquement un UUID pour chaque nouvel événement
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->id = Str::uuid();
        });
    }

    // Relation belongs-to avec la ville
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    // Relation many-to-many avec les utilisateurs
    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}
