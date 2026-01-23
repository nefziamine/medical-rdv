<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialty extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'icon',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($specialty) {
            if (empty($specialty->slug)) {
                $specialty->slug = \Str::slug($specialty->name);
            }
        });

        static::updating(function ($specialty) {
            if ($specialty->isDirty('name') && empty($specialty->slug)) {
                $specialty->slug = \Str::slug($specialty->name);
            }
        });
    }

    /**
     * Get the doctors in this specialty.
     */
    public function doctors()
    {
        return $this->hasMany(Doctor::class);
    }

    /**
     * Scope a query to only include active specialties.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope a query to order by sort order.
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }

    /**
     * Get the URL for this specialty.
     */
    public function getUrlAttribute(): string
    {
        return '/specialties/' . $this->slug;
    }
}
