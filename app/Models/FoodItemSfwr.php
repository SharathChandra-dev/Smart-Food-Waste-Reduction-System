<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FoodItemSfwr extends Model
{
    protected $table = 'FoodItems_sfwr';

    protected $primaryKey = 'id_food_sfwr';

    protected $fillable = [
        'foodname_sfwr',
        'foodcategory_sfwr',
        'manufacturing_date_sfwr',
        'expiry_date_sfwr',
        'foodquantity_sfwr',
        'calories_sfwr',
        'fooddescription_sfwr',
        'contact_sfwr',
        'pickup_location_sfwr',
        'available_till_sfwr',
        'foodimage_sfwr',
        'id_user_sfwr',
        'id_intake_sfwr'
    ];

    protected $dates = [
        'manufacturing_date_sfwr',
        'expiry_date_sfwr',
        'available_till_sfwr',
        'created_at',
        'updated_at',
    ];

    protected static function boot()
    {
        parent::boot();

        static::created(function ($model) {
            if (is_null($model->id_intake_sfwr)) {
                $intake = FoodIntakeSfwr::create([
                    'foodintake_sfwr' => $model->foodname_sfwr,
                    'id_user_sfwr' => $model->id_user_sfwr,
                    'intake_date_sfwr' => now()->toDateString(),
                    'notes_sfwr' => "Automatically created for {$model->foodname_sfwr} - Expires on {$model->expiry_date_sfwr}",
                ]);

                $model->update(['id_intake_sfwr' => $intake->id_intake_sfwr]);
            }
        });

        static::updated(function ($model) {
            if (!is_null($model->id_intake_sfwr)) {
                $intake = FoodIntakeSfwr::find($model->id_intake_sfwr);
                if ($intake && $intake->foodintake_sfwr !== $model->foodname_sfwr) {
                    $intake->update([
                        'foodintake_sfwr' => $model->foodname_sfwr,
                        'notes_sfwr' => "Updated for {$model->foodname_sfwr} - Expires on {$model->expiry_date_sfwr}",
                    ]);
                }
            }
        });

        static::deleted(function ($model) {
            if (!is_null($model->id_intake_sfwr)) {
                FoodIntakeSfwr::where('id_intake_sfwr', $model->id_intake_sfwr)->delete();
            }
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user_sfwr', 'id_user_sfwr');
    }

    public function foodIntake(): BelongsTo
    {
        return $this->belongsTo(FoodIntakeSfwr::class, 'id_intake_sfwr', 'id_intake_sfwr');
    }

    public function claims()
    {
        return $this->hasMany(FoodClaimSfwr::class, 'id_food_sfwr', 'id_food_sfwr');
    }

    public function scopeExpiringWithin($query, $days = 7)
    {
        return $query->where('expiry_date_sfwr', '<=', now()->addDays($days))->where('expiry_date_sfwr', '>=', now());
    }

    public function scopeExpired($query)
    {
        return $query->where('expiry_date_sfwr', '<', now());
    }

    public function scopeAvailable($query)
    {
        return $query->where('expiry_date_sfwr', '>=', now());
    }

    public function getExpiryStatusAttribute()
    {
        $today = now()->startOfDay();
        $expiry = \Carbon\Carbon::parse($this->expiry_date_sfwr)->startOfDay();

        if ($expiry->lt($today)) {
            return 'expired';
        } elseif ($expiry->lte($today->copy()->addDays(3))) {
            return 'expiring_soon';
        }
        return 'fresh';
    }
}