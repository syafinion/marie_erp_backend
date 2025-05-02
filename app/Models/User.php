<?php

/*
 * File: User.php
 * Project: Marie ERP
 * Created Date: March 2025
 * 
 * Copyright (c) 2025 Group 17
 * 
 * Authors:
 * - Syafiq - Group 17
 * 
 * Description:
 * Model representing user accounts in the Marie ERP system.
 * Handles user authentication, authorization and profile management.
 * Extends Laravel's Authenticatable class for built-in auth features.
 * 
 * Features:
 * - User authentication
 * - Profile management
 * - Password hashing
 * - Email verification
 * - Token-based API authentication
 * - Role-based access control
 * 
 * Database Fields:
 * - name: User's full name
 * - email: User's email address (unique)
 * - password: Hashed password
 * - token: API authentication token
 * - email_verified_at: Timestamp of email verification
 * - remember_token: Remember me token
 * 
 * Relationships:
 * - hasMany Ingredients
 * - hasMany Stocks
 * 
 * Modified/Adapted From:
 * - Laravel Authentication
 *   Source: https://laravel.com/docs/authentication
 * - Laravel Sanctum
 *   Source: https://laravel.com/docs/sanctum
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];
}
