<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

/**
 * @property-read string $full_name
 * @property-read string $full_post
 * @property-read string $phone_formatted
 */
class User extends Authenticatable implements HasMedia
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, InteractsWithMedia, HasRoles;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    protected $guard_name = 'api';
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
    ];

    /**
     * @return HasOne
     */
    public function faculty(): HasOne
    {
        return $this->hasOne(Faculty::class, 'id', 'faculty_id');
    }

    /**
     * @return HasOne
     */
    public function department(): HasOne
    {
        return $this->hasOne(Department::class, 'id', 'department_id');
    }

    /**
     * @return HasOne
     */
    public function post_name(): HasOne
    {
        return $this->hasOne(Role::class, 'id', 'post');
    }

    /**
     * @return string
     */
    public function getFullNameAttribute(): string
    {
        return "{$this->last_name} {$this->first_name} {$this->patronymic}";
    }

    /**
     * @return string
     */
    public function getFullPostAttribute(): string
    {
        $faculty = $this->faculty()->first();
        $department = $this->department()->first();
        $post = $this->post_name()->first();
        $return_value = "";
        if (!is_null($faculty) && !is_null($department)) {
            $return_value .= "{$faculty->short_name}, {$department->short_name}, ";
        }
        $return_value .= "{$post->name}";

        return $return_value;
    }

    /**
     * @return string
     */
    public function getPhoneFormattedAttribute(): string
    {
        if (is_null($this->phone)) {
            return '';
        }
        return vsprintf("+%d%d%d %d%d %d%d%d %d%d %d%d", str_split($this->phone));
    }
}
