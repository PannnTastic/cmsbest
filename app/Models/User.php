<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $primaryKey = 'user_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function carts(){
        return $this->hasMany(Cart::class, 'user_id');
    }

    public function setNameAttribute($value)
    {
        $this->attributes['nama_lengkap'] = $value;
    }

    // 2. Accessor: Saat sistem memanggil 'name', ambil dari 'nama_lengkap'
    public function getNameAttribute()
    {
        return $this->nama_lengkap;
    }

    // 3. Konfigurasi Filament: Beritahu Filament kolom mana yang harus ditampilkan sebagai nama di dashboard
    public function getFilamentName(): string
    {
        return $this->nama_lengkap;
    }
}
