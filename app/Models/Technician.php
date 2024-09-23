<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Technician extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'technicians'; // Nom de la table correcte

    protected $fillable = [
        'speciality',
        'grade',
        'user_id', // Ajoutez l'ID utilisateur
    ];

    // Relation avec le modèle User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    // Relation avec le modèle Role
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user', 'user_id', 'role_id');
    }
}
