<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Intervention extends Model
{
    use HasFactory;

    protected $fillable = [
        'panne_id',
        'technician_id',
        'start_date',
        'end_date',
        'comment',
    ];
    public function panne()
    {
        return $this->belongsTo(Panne::class);
    }

    public function technician()
    {
        return $this->belongsTo(User::class, 'technician_id');
    }

}
