<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FoodIntakeSfwr extends Model
{
    protected $table = 'foodintake_sfwr';

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

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user_sfwr', 'id_user_sfwr');
    }

    public function foodItems(): HasMany
    {
        return $this->hasMany(FoodItemSfwr::class, 'id_intake_sfwr', 'id_intake_sfwr');
    }

    public function scopeExpiringFoods($query)
    {
        return $query->with(['foodItems' => function ($q) {
            $q->where('expiry_date_sfwr', '<=', now()->addDays(7))->where('expiry_date_sfwr', '>=', now());
        }]);
    }
}