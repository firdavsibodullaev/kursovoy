<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
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

    protected $fillable = [
        'first_name',
        'last_name',
        'patronymic',
        'username',
        'password',
        'birthdate',
        'phone',
        'faculty_id',
        'department_id',
        'post',
        'email'
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
     * @return BelongsToMany
     */
    public function scientificArticles(): BelongsToMany
    {
        return $this->belongsToMany(
            ScientificArticle::class,
            'scientific_article_users',
            'user_id',
            'scientific_article_id');
    }

    /**
     * @return BelongsToMany
     */
    public function scientificArticleCitations(): BelongsToMany
    {
        return $this->belongsToMany(
            ScientificArticleCitation::class,
            'scientific_article_citation_user',
            'user_id',
            'scientific_article_citation_id');
    }

    /**
     * @return BelongsToMany
     */
    public function oakScientificArticles(): BelongsToMany
    {
        return $this->belongsToMany(
            OakScientificArticle::class,
            'oak_scientific_article_users',
            'user_id',
            'oak_scientific_article_id');
    }

    /**
     * @return BelongsToMany
     */
    public function scientificResearchEffectiveness(): BelongsToMany
    {
        return $this->belongsToMany(
            ScientificResearchEffectiveness::class,
            'scientific_research_effectiveness_users',
            'user_id',
            'scientific_research_effectiveness_id'
        );
    }

    /**
     * @return BelongsToMany
     */
    public function copyrightProtectedVariousMaterialInformation(): BelongsToMany
    {
        return $this->belongsToMany(
            CopyrightProtectedVariousMaterialInformation::class,
            'copyright_protected_various_material_information_users',
            'user_id',
            'copyright_protected_various_material_information_id'
        );
    }

    /**
     * @return BelongsToMany
     */
    public function obtainedIndustrialSamplePatent(): BelongsToMany
    {
        return $this->belongsToMany(
            ObtainedIndustrialSamplePatent::class,
            'obtained_industrial_sample_patent_users',
            'user_id',
            'obtained_industrial_sample_patent_id'
        );
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
        $faculty = $this->faculty;
        $department = $this->department;
        $post = $this->post_name;
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
        try {
            return vsprintf("+%d%d%d %d%d %d%d%d %d%d %d%d", str_split($this->phone));
        } catch (\Exception $exception) {
            return $this->phone;
        }
    }
}
