<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'name',
        'nik',
        'role',
        'statusenabled',
        'created_by',
        'email',
        'password',
        'uuid',
        'role_id',
        'departemen_id',
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

    public function roleRel()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }


    public function departemenRel()
    {
        return $this->belongsTo(Departemen::class, 'departemen_id');
    }

    public function allowedRoutes()
    {
        // ADMIN bypass semua
        if ($this->roleRel?->name === 'ADMIN') {
            return ['*'];
        }

        $roleRoutes = $this->roleRel->allowed_routes ?? [];
        $deptRoutes = $this->departemenRel->menu_routes ?? [];

        // ambil irisan role + departemen
        return array_values(array_intersect($roleRoutes, $deptRoutes));
    }

    public function canAccess($routeName)
    {
        $allowed = $this->allowedRoutes();

        return in_array('*', $allowed) || in_array($routeName, $allowed);
    }

    public function hasRoleId(array|int $roles): bool
    {
        $roles = (array) $roles;
        return in_array($this->role_id, $roles);
    }

    public function inDepartemenId(array|int $departemen): bool
    {
        $departemen = (array) $departemen;
        return in_array($this->departemen_id, $departemen);
    }
}
