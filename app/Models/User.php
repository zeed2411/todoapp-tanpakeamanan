<?php
// models\user.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = "users";

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Hapus 'password' => 'hashed' agar tidak otomatis bcrypt
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
        ];
    }
}
