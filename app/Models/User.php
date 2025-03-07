<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'full_name',
        'username',
        'email',
        'password',
        'contact_number',
        'role'
    ];

  
    protected $hidden = [
        'password',
        'remember_token'
    ];


    protected $casts = [
        'password' => 'hashed', 
    ];

    // Relationship: A user can have many contacts
    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }
}
