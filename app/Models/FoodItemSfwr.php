<?php

namespace App\Models;

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

    /**
     * Boot the model to attach event listeners
     */
    protected static function boot()
    {
        parent::boot();

        /**
         * Automatically create an intake record when a new food item is created
         */
        static::created(function ($model) {
            // Only create intake if one doesn't already exist
            if (is_null($model->id_intake_sfwr)) {
                $intake = FoodIntakeSfwr::create([
                    'foodintake_sfwr' => $model->foodname_sfwr,
                    'id_user_sfwr' => $model->id_user_sfwr,
                    'intake_date_sfwr' => now()->toDateString(),
                    'notes_sfwr' => "Automatically created for {$model->foodname_sfwr} - Expires on {$model->expiry_date_sfwr}",
                ]);

                // Update the food item with the intake record ID
                $model->update(['id_intake_sfwr' => $intake->id_intake_sfwr]);
            }
        });

        /**
         * Update intake record when food item is updated
         */
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

        /**
         * Optionally delete intake record when food item is deleted
         */
        static::deleted(function ($model) {
            if (!is_null($model->id_intake_sfwr)) {
                FoodIntakeSfwr::where('id_intake_sfwr', $model->id_intake_sfwr)->delete();
            }
        });
    }

    /**
     * Get the user who added this food item
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(UserSfwr::class, 'id_user_sfwr', 'id');
    }

    /**
     * Get the food intake record associated with this food item
     */
    public function foodIntake(): BelongsTo
    {
        return $this->belongsTo(FoodIntakeSfwr::class, 'id_intake_sfwr', 'id_intake_sfwr');
    }

    /**
     * Scope to get foods expiring within days
     */
    public function scopeExpiringWithin($query, $days = 7)
    {
        return $query->where('expiry_date_sfwr', '<=', now()->addDays($days))->where('expiry_date_sfwr', '>=', now());
    }

    /**
     * Scope to get foods that have expired
     */
    public function scopeExpired($query)
    {
        return $query->where('expiry_date_sfwr', '<', now());
    }

    /**
     * Scope to get foods available for consumption
     */
    public function scopeAvailable($query)
    {
        return $query->where('expiry_date_sfwr', '>=', now());
    }
}
