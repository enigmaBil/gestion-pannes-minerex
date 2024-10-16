<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'applicant',
        'responsible',
        'departement',
        'door_number',
        'hardware',
        'hardware_other',
        'serial_number',
        'model',
        'os_type',
        'licence',
        'other',
        'comment',
        'start_date',
        'end_date',
        'intervention_type',
        'other_intervention',
        'designation',
        'quantity',
        'connected',
        'protocol'
    ];
}
