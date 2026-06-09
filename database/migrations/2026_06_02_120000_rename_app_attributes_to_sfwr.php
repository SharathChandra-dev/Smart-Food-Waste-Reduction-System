<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('users')) {
            if (Schema::hasColumn('users', 'id')) {
                DB::statement('ALTER TABLE `users` CHANGE `id` `id_user_sfwr` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT');
            }
            if (Schema::hasColumn('users', 'name')) {
                DB::statement('ALTER TABLE `users` CHANGE `name` `name_sfwr` VARCHAR(255) NOT NULL');
            }
            if (Schema::hasColumn('users', 'email')) {
                DB::statement('ALTER TABLE `users` CHANGE `email` `email_sfwr` VARCHAR(255) NOT NULL');
            }
            if (Schema::hasColumn('users', 'email_verified_at')) {
                DB::statement('ALTER TABLE `users` CHANGE `email_verified_at` `email_verified_at_sfwr` TIMESTAMP NULL DEFAULT NULL');
            }
            if (Schema::hasColumn('users', 'password')) {
                DB::statement('ALTER TABLE `users` CHANGE `password` `password_sfwr` VARCHAR(255) NOT NULL');
            }
            if (Schema::hasColumn('users', 'remember_token')) {
                DB::statement('ALTER TABLE `users` CHANGE `remember_token` `remember_token_sfwr` VARCHAR(100) DEFAULT NULL');
            }
        }

        if (Schema::hasTable('food_items')) {
            if (Schema::hasColumn('food_items', 'id')) {
                DB::statement('ALTER TABLE `food_items` CHANGE `id` `id_food_sfwr` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT');
            }
            if (Schema::hasColumn('food_items', 'name')) {
                DB::statement('ALTER TABLE `food_items` CHANGE `name` `foodname_sfwr` VARCHAR(255) NOT NULL');
            }
            if (Schema::hasColumn('food_items', 'description')) {
                DB::statement('ALTER TABLE `food_items` CHANGE `description` `fooddescription_sfwr` TEXT NOT NULL');
            }
            if (Schema::hasColumn('food_items', 'contact')) {
                DB::statement('ALTER TABLE `food_items` CHANGE `contact` `contact_sfwr` VARCHAR(255) NOT NULL');
            }
            if (Schema::hasColumn('food_items', 'pickup_location')) {
                DB::statement('ALTER TABLE `food_items` CHANGE `pickup_location` `pickup_location_sfwr` VARCHAR(255) NOT NULL');
            }
            if (Schema::hasColumn('food_items', 'expiry_date')) {
                DB::statement('ALTER TABLE `food_items` CHANGE `expiry_date` `expiry_date_sfwr` DATE NOT NULL');
            }
            if (Schema::hasColumn('food_items', 'image')) {
                DB::statement('ALTER TABLE `food_items` CHANGE `image` `foodimage_sfwr` VARCHAR(255) DEFAULT NULL');
            }
        }

        if (Schema::hasTable('user_2fa')) {
            if (Schema::hasColumn('user_2fa', 'id')) {
                DB::statement('ALTER TABLE `user_2fa` CHANGE `id` `id_user_2fa_sfwr` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT');
            }
            if (Schema::hasColumn('user_2fa', 'user_id')) {
                DB::statement('ALTER TABLE `user_2fa` CHANGE `user_id` `user_id_sfwr` INT UNSIGNED NOT NULL');
            }
            if (Schema::hasColumn('user_2fa', 'secret_base32')) {
                DB::statement('ALTER TABLE `user_2fa` CHANGE `secret_base32` `secret_base32_sfwr` VARCHAR(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL');
            }
            if (Schema::hasColumn('user_2fa', 'enabled')) {
                DB::statement('ALTER TABLE `user_2fa` CHANGE `enabled` `enabled_sfwr` TINYINT(1) NOT NULL DEFAULT 0');
            }
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('user_2fa')) {
            if (Schema::hasColumn('user_2fa', 'enabled_sfwr')) {
                DB::statement('ALTER TABLE `user_2fa` CHANGE `enabled_sfwr` `enabled` TINYINT(1) NOT NULL DEFAULT 0');
            }
            if (Schema::hasColumn('user_2fa', 'secret_base32_sfwr')) {
                DB::statement('ALTER TABLE `user_2fa` CHANGE `secret_base32_sfwr` `secret_base32` VARCHAR(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL');
            }
            if (Schema::hasColumn('user_2fa', 'user_id_sfwr')) {
                DB::statement('ALTER TABLE `user_2fa` CHANGE `user_id_sfwr` `user_id` INT UNSIGNED NOT NULL');
            }
            if (Schema::hasColumn('user_2fa', 'id_user_2fa_sfwr')) {
                DB::statement('ALTER TABLE `user_2fa` CHANGE `id_user_2fa_sfwr` `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT');
            }
        }

        if (Schema::hasTable('food_items')) {
            if (Schema::hasColumn('food_items', 'foodimage_sfwr')) {
                DB::statement('ALTER TABLE `food_items` CHANGE `foodimage_sfwr` `image` VARCHAR(255) DEFAULT NULL');
            }
            if (Schema::hasColumn('food_items', 'expiry_date_sfwr')) {
                DB::statement('ALTER TABLE `food_items` CHANGE `expiry_date_sfwr` `expiry_date` DATE NOT NULL');
            }
            if (Schema::hasColumn('food_items', 'pickup_location_sfwr')) {
                DB::statement('ALTER TABLE `food_items` CHANGE `pickup_location_sfwr` `pickup_location` VARCHAR(255) NOT NULL');
            }
            if (Schema::hasColumn('food_items', 'contact_sfwr')) {
                DB::statement('ALTER TABLE `food_items` CHANGE `contact_sfwr` `contact` VARCHAR(255) NOT NULL');
            }
            if (Schema::hasColumn('food_items', 'fooddescription_sfwr')) {
                DB::statement('ALTER TABLE `food_items` CHANGE `fooddescription_sfwr` `description` TEXT NOT NULL');
            }
            if (Schema::hasColumn('food_items', 'foodname_sfwr')) {
                DB::statement('ALTER TABLE `food_items` CHANGE `foodname_sfwr` `name` VARCHAR(255) NOT NULL');
            }
            if (Schema::hasColumn('food_items', 'id_food_sfwr')) {
                DB::statement('ALTER TABLE `food_items` CHANGE `id_food_sfwr` `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT');
            }
        }

        if (Schema::hasTable('users')) {
            if (Schema::hasColumn('users', 'remember_token_sfwr')) {
                DB::statement('ALTER TABLE `users` CHANGE `remember_token_sfwr` `remember_token` VARCHAR(100) DEFAULT NULL');
            }
            if (Schema::hasColumn('users', 'password_sfwr')) {
                DB::statement('ALTER TABLE `users` CHANGE `password_sfwr` `password` VARCHAR(255) NOT NULL');
            }
            if (Schema::hasColumn('users', 'email_verified_at_sfwr')) {
                DB::statement('ALTER TABLE `users` CHANGE `email_verified_at_sfwr` `email_verified_at` TIMESTAMP NULL DEFAULT NULL');
            }
            if (Schema::hasColumn('users', 'email_sfwr')) {
                DB::statement('ALTER TABLE `users` CHANGE `email_sfwr` `email` VARCHAR(255) NOT NULL');
            }
            if (Schema::hasColumn('users', 'name_sfwr')) {
                DB::statement('ALTER TABLE `users` CHANGE `name_sfwr` `name` VARCHAR(255) NOT NULL');
            }
            if (Schema::hasColumn('users', 'id_user_sfwr')) {
                DB::statement('ALTER TABLE `users` CHANGE `id_user_sfwr` `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT');
            }
        }
    }
};
