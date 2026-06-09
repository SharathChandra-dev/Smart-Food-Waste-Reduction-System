<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FoodIntakeSfwr extends Model
{
    protected $table = 'FoodIntake_sfwr';

    protected $primaryKey = 'id_intake_sfwr';

    protected $fillable = [
        'foodintake_sfwr',
        'id_user_sfwr',
        'intake_date_sfwr',
        'notes_sfwr',
    ];

    protected $dates = [
        'intake_date_sfwr',
        'created_at',
        'updated_at',
    ];

    /**
     * Get the user associated with this intake record
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(UserSfwr::class, 'id_user_sfwr', 'id');
    }

    /**
     * Get all food items linked to this intake record
     */
    public function foodItems(): HasMany
    {
        return $this->hasMany(FoodItemSfwr::class, 'id_intake_sfwr', 'id_intake_sfwr');
    }

    /**
     * Scope to get foods expiring soon (within 7 days)
     */
    public function scopeExpiringFoods($query)
    {
        return $query->with(['foodItems' => function ($q) {
            $q->where('expiry_date_sfwr', '<=', now()->addDays(7))->where('expiry_date_sfwr', '>=', now());
        }]);
    }
}
