<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // Pastikan 'role' bisa diisi
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Mendapatkan data penjahit yang terkait dengan pengguna.
     */
    public function tailor()
    {
        return $this->hasOne(Tailor::class);
    }

    /**
     * Mendapatkan data investor yang terkait dengan pengguna.
     */
    public function investor()
    {
        return $this->hasOne(Investor::class);
    }

    /**
     * Relasi "jalan pintas" dari User ke Investment melalui Investor.
     * Ini akan menyelesaikan error 'undefined method investments()'.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function investments()
    {
        return $this->hasManyThrough(
            Investment::class, // Model akhir yang ingin diakses
            Investor::class,   // Model perantara
            'user_id',         // Foreign key di tabel investors (yang terhubung ke users)
            'investor_id',     // Foreign key di tabel investments (yang terhubung ke investors)
            'id',              // Local key di tabel users
            'investor_id'      // Local key di tabel investors
        );
    }
}