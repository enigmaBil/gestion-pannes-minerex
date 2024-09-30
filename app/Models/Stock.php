<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Stock extends Model
{
    use HasFactory, SoftDeletes ;

    protected $table = 'stocks';

    protected $fillable = [
        'product_name',
        'description',
        'quantity',
        'location',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    /**
     * Utilisateur qui a créé le stock.
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Utilisateur qui a mis à jour le stock.
     */
    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    /**
     * Utilisateur qui a supprimé le stock.
     */
    public function deleter()
    {
        return $this->belongsTo(User::class, 'deleted_by');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($stock) {
            $stock->created_by = auth()->id();
        });

        static::updating(function ($stock) {
            $stock->updated_by = auth()->id();
        });

        static::deleting(function ($stock) {
            if (! $stock->isForceDeleting()) {
                $stock->deleted_by = auth()->id();
                $stock->save();
            }
        });
    }

}
