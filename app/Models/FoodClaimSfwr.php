<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FoodClaimSfwr extends Model
{
    protected $table = 'food_claims_sfwr';
    protected $primaryKey = 'id_claim_sfwr';

    protected $fillable = [
        'id_food_sfwr',
        'id_user_sfwr',
        'status_sfwr',
        'claimed_at',
    ];

    protected $casts = [
        'claimed_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function foodItem(): BelongsTo
    {
        return $this->belongsTo(FoodItemSfwr::class, 'id_food_sfwr', 'id_food_sfwr');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user_sfwr', 'id_user_sfwr');
    }
}
