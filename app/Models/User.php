<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'telepon',
        'alamat',
    ];

    /**
     * Gunakan UUID sebagai primary key.
     */
    protected $keyType = 'string';
    public $incrementing = false;

    /**
     * Boot method untuk generate UUID otomatis.
     */

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isUser()
    {
        return $this->role === 'user';
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }

    /**
     * Relasi: User memiliki banyak peminjaman.
     */
    public function loans()
    {
        return $this->hasMany(Loan::class);
    }
}
