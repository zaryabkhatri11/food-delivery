<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enum\RoleName;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
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


    public function roles() :BelongsToMany {
        return $this->belongsToMany(Role::class);
    }

    public function isAdmin() : bool
    {
        return $this->hasRole(RoleName::ADMIN);
    }

    public function isVendor(): bool
    {
     return   $this->hasRole(RoleName::VENDOR);
    }

    public function isStaff(): bool
    {
        return   $this->hasRole(RoleName::STAFF);
    }
    public function isCustomer(): bool
    {
        return   $this->hasRole(RoleName::CUSTOMER);
    }

    public function hasRole(RoleName $roleName): bool
    {
        return $this->roles()->where('name', $roleName->value)->exists();
    }

    public function permissions(): array
    {
     return $this->roles()->with('permissions')->get()
         ->map(function ($role){
                return $role->permissions->pluck('name');
         })->flatten()->values()->unique()->toArray();
    }

    public function hasPermission(string $permission): bool
    {
        return  in_array($permission, $this->Permissions() , true);
    }


    public function restaurants() :HasOne
    {
        return $this->hasOne(Restaurant::class, 'owner_id');
    }
}
