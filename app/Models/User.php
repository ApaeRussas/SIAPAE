<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'access_level',
        'position',
        'state_user'
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

    public function attendances(): HasMany
    {
        return $this->hasMany(Attendance::class, 'signature_id');
    }
    public function educational(): HasMany
    {
        return $this->hasMany(Educational::class, 'signature_id');
    }
    public function regional(): HasMany
    {
        return $this->hasMany(Regional::class, 'signature_id');
    }
    public function frequency(): HasMany
    {
        return $this->hasMany(Frequency::class, 'signature_id');
    }
    public function anamnesis(): HasMany
    {
        return $this->hasMany(MedHistory::class, 'signature_id');
    }
    public function scfv(): HasMany
    {
        return $this->hasMany(Scfv::class, 'signature_id');
    }
}
