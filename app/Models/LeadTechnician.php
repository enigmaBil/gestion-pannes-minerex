<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class LeadTechnician extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'lead_technicians'; // Nom de la table correcte
    protected $fillable = [

        'technician_id',
        'speciality',
        'grade'
    ];

    public function technician()
    {
        return $this->belongsTo(Technician::class);
    }
}
