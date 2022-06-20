<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\BaseModel
 *
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|\Spatie\MediaLibrary\MediaCollections\Models\Media[] $media
 * @property-read int|null $media_count
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel newQuery()
 * @method static \Illuminate\Database\Query\Builder|BaseModel onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel query()
 * @method static \Illuminate\Database\Query\Builder|BaseModel withTrashed()
 * @method static \Illuminate\Database\Query\Builder|BaseModel withoutTrashed()
 */
	class BaseModel extends \Eloquent implements \Spatie\MediaLibrary\HasMedia {}
}

namespace App\Models{
/**
 * App\Models\CopyrightProtectedVariousMaterialInformation
 *
 * @property int $id
 * @property int|null $institute_id
 * @property string $name
 * @property string $date
 * @property string $serial
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property bool $is_confirmed
 * @property string|null $confirmed_at
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Media|null $file
 * @property-read string $users_formatted
 * @property-read \App\Models\Institute|null $institute
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|\Spatie\MediaLibrary\MediaCollections\Models\Media[] $media
 * @property-read int|null $media_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|CopyrightProtectedVariousMaterialInformation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CopyrightProtectedVariousMaterialInformation newQuery()
 * @method static \Illuminate\Database\Query\Builder|CopyrightProtectedVariousMaterialInformation onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CopyrightProtectedVariousMaterialInformation query()
 * @method static \Illuminate\Database\Eloquent\Builder|CopyrightProtectedVariousMaterialInformation whereConfirmedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CopyrightProtectedVariousMaterialInformation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CopyrightProtectedVariousMaterialInformation whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CopyrightProtectedVariousMaterialInformation whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CopyrightProtectedVariousMaterialInformation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CopyrightProtectedVariousMaterialInformation whereInstituteId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CopyrightProtectedVariousMaterialInformation whereIsConfirmed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CopyrightProtectedVariousMaterialInformation whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CopyrightProtectedVariousMaterialInformation whereSerial($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CopyrightProtectedVariousMaterialInformation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|CopyrightProtectedVariousMaterialInformation withTrashed()
 * @method static \Illuminate\Database\Query\Builder|CopyrightProtectedVariousMaterialInformation withoutTrashed()
 */
	class CopyrightProtectedVariousMaterialInformation extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\CopyrightProtectedVariousMaterialInformationUser
 *
 * @property int $id
 * @property int $copyright_information_id
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|\Spatie\MediaLibrary\MediaCollections\Models\Media[] $media
 * @property-read int|null $media_count
 * @method static \Illuminate\Database\Eloquent\Builder|CopyrightProtectedVariousMaterialInformationUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CopyrightProtectedVariousMaterialInformationUser newQuery()
 * @method static \Illuminate\Database\Query\Builder|CopyrightProtectedVariousMaterialInformationUser onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CopyrightProtectedVariousMaterialInformationUser query()
 * @method static \Illuminate\Database\Eloquent\Builder|CopyrightProtectedVariousMaterialInformationUser whereCopyrightInformationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CopyrightProtectedVariousMaterialInformationUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CopyrightProtectedVariousMaterialInformationUser whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CopyrightProtectedVariousMaterialInformationUser whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CopyrightProtectedVariousMaterialInformationUser whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CopyrightProtectedVariousMaterialInformationUser whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|CopyrightProtectedVariousMaterialInformationUser withTrashed()
 * @method static \Illuminate\Database\Query\Builder|CopyrightProtectedVariousMaterialInformationUser withoutTrashed()
 */
	class CopyrightProtectedVariousMaterialInformationUser extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Country
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|\Spatie\MediaLibrary\MediaCollections\Models\Media[] $media
 * @property-read int|null $media_count
 * @method static \Illuminate\Database\Eloquent\Builder|Country newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Country newQuery()
 * @method static \Illuminate\Database\Query\Builder|Country onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Country query()
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Country withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Country withoutTrashed()
 */
	class Country extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\DScDoctor
 *
 * @property-read string $user_full_name
 * @property-read string $diploma_formatted
 * @property-read string $diploma_without_science_degree_formatted
 * @property-read string $employment_formatted
 * @property int $id
 * @property object $user
 * @property array|null $diploma
 * @property array|null $professor_without_science_degree
 * @property string|null $speciality_name
 * @property array|null $employment
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|\Spatie\MediaLibrary\MediaCollections\Models\Media[] $media
 * @property-read int|null $media_count
 * @method static \Database\Factories\DScDoctorFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|DScDoctor newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DScDoctor newQuery()
 * @method static \Illuminate\Database\Query\Builder|DScDoctor onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|DScDoctor query()
 * @method static \Illuminate\Database\Eloquent\Builder|DScDoctor whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DScDoctor whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DScDoctor whereDiploma($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DScDoctor whereEmployment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DScDoctor whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DScDoctor whereProfessorWithoutScienceDegree($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DScDoctor whereSpecialityName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DScDoctor whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DScDoctor whereUser($value)
 * @method static \Illuminate\Database\Query\Builder|DScDoctor withTrashed()
 * @method static \Illuminate\Database\Query\Builder|DScDoctor withoutTrashed()
 */
	class DScDoctor extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Department
 *
 * @property int $id
 * @property array $full_name
 * @property array $short_name
 * @property int $faculty_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Faculty|null $faculty
 * @property-read array $translations
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|\Spatie\MediaLibrary\MediaCollections\Models\Media[] $media
 * @property-read int|null $media_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Department newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Department newQuery()
 * @method static \Illuminate\Database\Query\Builder|Department onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Department query()
 * @method static \Illuminate\Database\Eloquent\Builder|Department whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Department whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Department whereFacultyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Department whereFullName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Department whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Department whereShortName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Department whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Department withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Department withoutTrashed()
 */
	class Department extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Employee
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string|null $patronymic
 * @property string|null $phone
 * @property int|null $faculty_id
 * @property int|null $department_id
 * @property string|null $post
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|\Spatie\MediaLibrary\MediaCollections\Models\Media[] $media
 * @property-read int|null $media_count
 * @method static \Illuminate\Database\Eloquent\Builder|Employee newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Employee newQuery()
 * @method static \Illuminate\Database\Query\Builder|Employee onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Employee query()
 * @method static \Illuminate\Database\Eloquent\Builder|Employee whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employee whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employee whereDepartmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employee whereFacultyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employee whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employee whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employee whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employee wherePatronymic($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employee wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employee wherePost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employee whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Employee withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Employee withoutTrashed()
 */
	class Employee extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Faculty
 *
 * @property int $id
 * @property array $full_name
 * @property array $short_name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Department[] $departments
 * @property-read int|null $departments_count
 * @property-read array $translations
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|\Spatie\MediaLibrary\MediaCollections\Models\Media[] $media
 * @property-read int|null $media_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Faculty newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Faculty newQuery()
 * @method static \Illuminate\Database\Query\Builder|Faculty onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Faculty query()
 * @method static \Illuminate\Database\Eloquent\Builder|Faculty whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Faculty whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Faculty whereFullName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Faculty whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Faculty whereShortName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Faculty whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Faculty withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Faculty withoutTrashed()
 */
	class Faculty extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\GrantFundOrder
 *
 * @property-read User $user
 * @property int $id
 * @property string $name
 * @property string|null $price
 * @property string $full_price
 * @property int $year
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int $user_id
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|\Spatie\MediaLibrary\MediaCollections\Models\Media[] $media
 * @property-read int|null $media_count
 * @method static \Illuminate\Database\Eloquent\Builder|GrantFundOrder newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GrantFundOrder newQuery()
 * @method static \Illuminate\Database\Query\Builder|GrantFundOrder onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|GrantFundOrder query()
 * @method static \Illuminate\Database\Eloquent\Builder|GrantFundOrder whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GrantFundOrder whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GrantFundOrder whereFullPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GrantFundOrder whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GrantFundOrder whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GrantFundOrder wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GrantFundOrder whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GrantFundOrder whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GrantFundOrder whereYear($value)
 * @method static \Illuminate\Database\Query\Builder|GrantFundOrder withTrashed()
 * @method static \Illuminate\Database\Query\Builder|GrantFundOrder withoutTrashed()
 */
	class GrantFundOrder extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Institute
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|\Spatie\MediaLibrary\MediaCollections\Models\Media[] $media
 * @property-read int|null $media_count
 * @method static \Illuminate\Database\Eloquent\Builder|Institute newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Institute newQuery()
 * @method static \Illuminate\Database\Query\Builder|Institute onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Institute query()
 * @method static \Illuminate\Database\Eloquent\Builder|Institute whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Institute whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Institute whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Institute whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Institute whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Institute withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Institute withoutTrashed()
 */
	class Institute extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Magazine
 *
 * @property int $id
 * @property string $title
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|\Spatie\MediaLibrary\MediaCollections\Models\Media[] $media
 * @property-read int|null $media_count
 * @method static \Illuminate\Database\Eloquent\Builder|Magazine newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Magazine newQuery()
 * @method static \Illuminate\Database\Query\Builder|Magazine onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Magazine query()
 * @method static \Illuminate\Database\Eloquent\Builder|Magazine whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Magazine whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Magazine whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Magazine whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Magazine whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Magazine withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Magazine withoutTrashed()
 */
	class Magazine extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\OakScientificArticle
 *
 * @property int $id
 * @property string $title
 * @property int $publish_year
 * @property string $pages
 * @property string $link
 * @property int $magazine_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property bool $is_confirmed
 * @property-read string $users_formatted
 * @property-read \App\Models\Magazine $magazine
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|\Spatie\MediaLibrary\MediaCollections\Models\Media[] $media
 * @property-read int|null $media_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|OakScientificArticle newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OakScientificArticle newQuery()
 * @method static \Illuminate\Database\Query\Builder|OakScientificArticle onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|OakScientificArticle query()
 * @method static \Illuminate\Database\Eloquent\Builder|OakScientificArticle whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OakScientificArticle whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OakScientificArticle whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OakScientificArticle whereIsConfirmed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OakScientificArticle whereLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OakScientificArticle whereMagazineId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OakScientificArticle wherePages($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OakScientificArticle wherePublishYear($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OakScientificArticle whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OakScientificArticle whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|OakScientificArticle withTrashed()
 * @method static \Illuminate\Database\Query\Builder|OakScientificArticle withoutTrashed()
 */
	class OakScientificArticle extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\OakScientificArticleUser
 *
 * @property int $id
 * @property int $user_id
 * @property int $oak_scientific_article_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|\Spatie\MediaLibrary\MediaCollections\Models\Media[] $media
 * @property-read int|null $media_count
 * @method static \Illuminate\Database\Eloquent\Builder|OakScientificArticleUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OakScientificArticleUser newQuery()
 * @method static \Illuminate\Database\Query\Builder|OakScientificArticleUser onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|OakScientificArticleUser query()
 * @method static \Illuminate\Database\Eloquent\Builder|OakScientificArticleUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OakScientificArticleUser whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OakScientificArticleUser whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OakScientificArticleUser whereOakScientificArticleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OakScientificArticleUser whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OakScientificArticleUser whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|OakScientificArticleUser withTrashed()
 * @method static \Illuminate\Database\Query\Builder|OakScientificArticleUser withoutTrashed()
 */
	class OakScientificArticleUser extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ObtainedIndustrialSamplePatent
 *
 * @property int $id
 * @property int|null $institute_id
 * @property string $name
 * @property string $date
 * @property string $number
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property bool $is_confirmed
 * @property string|null $confirmed_at
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Media|null $file
 * @property-read string $users_formatted
 * @property-read \App\Models\Institute|null $institute
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|\Spatie\MediaLibrary\MediaCollections\Models\Media[] $media
 * @property-read int|null $media_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|ObtainedIndustrialSamplePatent newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ObtainedIndustrialSamplePatent newQuery()
 * @method static \Illuminate\Database\Query\Builder|ObtainedIndustrialSamplePatent onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ObtainedIndustrialSamplePatent query()
 * @method static \Illuminate\Database\Eloquent\Builder|ObtainedIndustrialSamplePatent whereConfirmedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ObtainedIndustrialSamplePatent whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ObtainedIndustrialSamplePatent whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ObtainedIndustrialSamplePatent whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ObtainedIndustrialSamplePatent whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ObtainedIndustrialSamplePatent whereInstituteId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ObtainedIndustrialSamplePatent whereIsConfirmed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ObtainedIndustrialSamplePatent whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ObtainedIndustrialSamplePatent whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ObtainedIndustrialSamplePatent whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|ObtainedIndustrialSamplePatent withTrashed()
 * @method static \Illuminate\Database\Query\Builder|ObtainedIndustrialSamplePatent withoutTrashed()
 */
	class ObtainedIndustrialSamplePatent extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ObtainedIndustrialSamplePatentUser
 *
 * @property int $id
 * @property int $user_id
 * @property int $obtained_industrial_sample_patent_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|\Spatie\MediaLibrary\MediaCollections\Models\Media[] $media
 * @property-read int|null $media_count
 * @method static \Illuminate\Database\Eloquent\Builder|ObtainedIndustrialSamplePatentUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ObtainedIndustrialSamplePatentUser newQuery()
 * @method static \Illuminate\Database\Query\Builder|ObtainedIndustrialSamplePatentUser onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ObtainedIndustrialSamplePatentUser query()
 * @method static \Illuminate\Database\Eloquent\Builder|ObtainedIndustrialSamplePatentUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ObtainedIndustrialSamplePatentUser whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ObtainedIndustrialSamplePatentUser whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ObtainedIndustrialSamplePatentUser whereObtainedIndustrialSamplePatentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ObtainedIndustrialSamplePatentUser whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ObtainedIndustrialSamplePatentUser whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|ObtainedIndustrialSamplePatentUser withTrashed()
 * @method static \Illuminate\Database\Query\Builder|ObtainedIndustrialSamplePatentUser withoutTrashed()
 */
	class ObtainedIndustrialSamplePatentUser extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PhdDoctor
 *
 * @property-read string $user_full_name
 * @property-read string $diploma_formatted
 * @property-read string $diploma_without_science_degree_formatted
 * @property-read string $employment_formatted
 * @property int $id
 * @property object $user
 * @property array|null $diploma
 * @property array|null $professor_without_science_degree
 * @property string|null $speciality_name
 * @property array|null $employment
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|\Spatie\MediaLibrary\MediaCollections\Models\Media[] $media
 * @property-read int|null $media_count
 * @method static \Database\Factories\PhdDoctorFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|PhdDoctor newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PhdDoctor newQuery()
 * @method static \Illuminate\Database\Query\Builder|PhdDoctor onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|PhdDoctor query()
 * @method static \Illuminate\Database\Eloquent\Builder|PhdDoctor whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PhdDoctor whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PhdDoctor whereDiploma($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PhdDoctor whereEmployment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PhdDoctor whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PhdDoctor whereProfessorWithoutScienceDegree($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PhdDoctor whereSpecialityName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PhdDoctor whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PhdDoctor whereUser($value)
 * @method static \Illuminate\Database\Query\Builder|PhdDoctor withTrashed()
 * @method static \Illuminate\Database\Query\Builder|PhdDoctor withoutTrashed()
 */
	class PhdDoctor extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Publication
 *
 * @property int $id
 * @property string $title
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|\Spatie\MediaLibrary\MediaCollections\Models\Media[] $media
 * @property-read int|null $media_count
 * @method static \Illuminate\Database\Eloquent\Builder|Publication newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Publication newQuery()
 * @method static \Illuminate\Database\Query\Builder|Publication onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Publication query()
 * @method static \Illuminate\Database\Eloquent\Builder|Publication whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Publication whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Publication whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Publication whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Publication whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Publication withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Publication withoutTrashed()
 */
	class Publication extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ScientificArticle
 *
 * @property int $id
 * @property string $title
 * @property int $publish_year
 * @property string $pages
 * @property string $link
 * @property int $magazine_id
 * @property int $country_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property bool $is_confirmed
 * @property-read \App\Models\Country $country
 * @property-read string $users_formatted
 * @property-read \App\Models\Magazine $magazine
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|\Spatie\MediaLibrary\MediaCollections\Models\Media[] $media
 * @property-read int|null $media_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 * @method static \Database\Factories\ScientificArticleFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|ScientificArticle newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ScientificArticle newQuery()
 * @method static \Illuminate\Database\Query\Builder|ScientificArticle onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ScientificArticle query()
 * @method static \Illuminate\Database\Eloquent\Builder|ScientificArticle whereCountryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ScientificArticle whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ScientificArticle whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ScientificArticle whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ScientificArticle whereIsConfirmed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ScientificArticle whereLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ScientificArticle whereMagazineId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ScientificArticle wherePages($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ScientificArticle wherePublishYear($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ScientificArticle whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ScientificArticle whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|ScientificArticle withTrashed()
 * @method static \Illuminate\Database\Query\Builder|ScientificArticle withoutTrashed()
 */
	class ScientificArticle extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ScientificArticleCitation
 *
 * @property-read Collection $users
 * @property int $id
 * @property int $magazine_id
 * @property string $magazine_publish_date
 * @property string $article_title
 * @property string $article_language
 * @property string $link
 * @property int $citations_count
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property bool $is_confirmed
 * @property-read string $users_formatted
 * @property-read \App\Models\Magazine|null $magazine
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|\Spatie\MediaLibrary\MediaCollections\Models\Media[] $media
 * @property-read int|null $media_count
 * @property-read int|null $users_count
 * @method static \Database\Factories\ScientificArticleCitationFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|ScientificArticleCitation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ScientificArticleCitation newQuery()
 * @method static \Illuminate\Database\Query\Builder|ScientificArticleCitation onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ScientificArticleCitation query()
 * @method static \Illuminate\Database\Eloquent\Builder|ScientificArticleCitation whereArticleLanguage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ScientificArticleCitation whereArticleTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ScientificArticleCitation whereCitationsCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ScientificArticleCitation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ScientificArticleCitation whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ScientificArticleCitation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ScientificArticleCitation whereIsConfirmed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ScientificArticleCitation whereLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ScientificArticleCitation whereMagazineId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ScientificArticleCitation whereMagazinePublishDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ScientificArticleCitation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|ScientificArticleCitation withTrashed()
 * @method static \Illuminate\Database\Query\Builder|ScientificArticleCitation withoutTrashed()
 */
	class ScientificArticleCitation extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ScientificArticleCitationUser
 *
 * @property int $citation_id
 * @property int $user_id
 * @method static \Illuminate\Database\Eloquent\Builder|ScientificArticleCitationUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ScientificArticleCitationUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ScientificArticleCitationUser query()
 * @method static \Illuminate\Database\Eloquent\Builder|ScientificArticleCitationUser whereCitationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ScientificArticleCitationUser whereUserId($value)
 */
	class ScientificArticleCitationUser extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ScientificArticleUser
 *
 * @method static \Illuminate\Database\Eloquent\Builder|ScientificArticleUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ScientificArticleUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ScientificArticleUser query()
 */
	class ScientificArticleUser extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ScientificResearchConduct
 *
 * @property-read User $user
 * @property int $id
 * @property string $name
 * @property string|null $price
 * @property string $full_price
 * @property int $year
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int $user_id
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|\Spatie\MediaLibrary\MediaCollections\Models\Media[] $media
 * @property-read int|null $media_count
 * @method static \Illuminate\Database\Eloquent\Builder|ScientificResearchConduct newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ScientificResearchConduct newQuery()
 * @method static \Illuminate\Database\Query\Builder|ScientificResearchConduct onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ScientificResearchConduct query()
 * @method static \Illuminate\Database\Eloquent\Builder|ScientificResearchConduct whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ScientificResearchConduct whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ScientificResearchConduct whereFullPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ScientificResearchConduct whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ScientificResearchConduct whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ScientificResearchConduct wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ScientificResearchConduct whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ScientificResearchConduct whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ScientificResearchConduct whereYear($value)
 * @method static \Illuminate\Database\Query\Builder|ScientificResearchConduct withTrashed()
 * @method static \Illuminate\Database\Query\Builder|ScientificResearchConduct withoutTrashed()
 */
	class ScientificResearchConduct extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ScientificResearchEffectiveness
 *
 * @property int $id
 * @property string $specialized_name
 * @property string $specialized_code
 * @property string $name
 * @property string $accepted_report
 * @property string $accepted_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int $publication_id
 * @property bool $is_confirmed
 * @property string|null $confirmed_at
 * @property-read string $accept
 * @property-read string $specialize
 * @property-read string $users_formatted
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|\Spatie\MediaLibrary\MediaCollections\Models\Media[] $media
 * @property-read int|null $media_count
 * @property-read \App\Models\Publication $publication
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|ScientificResearchEffectiveness newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ScientificResearchEffectiveness newQuery()
 * @method static \Illuminate\Database\Query\Builder|ScientificResearchEffectiveness onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ScientificResearchEffectiveness query()
 * @method static \Illuminate\Database\Eloquent\Builder|ScientificResearchEffectiveness whereAcceptedDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ScientificResearchEffectiveness whereAcceptedReport($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ScientificResearchEffectiveness whereConfirmedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ScientificResearchEffectiveness whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ScientificResearchEffectiveness whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ScientificResearchEffectiveness whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ScientificResearchEffectiveness whereIsConfirmed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ScientificResearchEffectiveness whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ScientificResearchEffectiveness wherePublicationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ScientificResearchEffectiveness whereSpecializedCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ScientificResearchEffectiveness whereSpecializedName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ScientificResearchEffectiveness whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|ScientificResearchEffectiveness withTrashed()
 * @method static \Illuminate\Database\Query\Builder|ScientificResearchEffectiveness withoutTrashed()
 */
	class ScientificResearchEffectiveness extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ScientificResearchEffectivenessUser
 *
 * @property int $id
 * @property int $scientific_research_effectiveness_id
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|\Spatie\MediaLibrary\MediaCollections\Models\Media[] $media
 * @property-read int|null $media_count
 * @method static \Illuminate\Database\Eloquent\Builder|ScientificResearchEffectivenessUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ScientificResearchEffectivenessUser newQuery()
 * @method static \Illuminate\Database\Query\Builder|ScientificResearchEffectivenessUser onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ScientificResearchEffectivenessUser query()
 * @method static \Illuminate\Database\Eloquent\Builder|ScientificResearchEffectivenessUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ScientificResearchEffectivenessUser whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ScientificResearchEffectivenessUser whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ScientificResearchEffectivenessUser whereScientificResearchEffectivenessId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ScientificResearchEffectivenessUser whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ScientificResearchEffectivenessUser whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|ScientificResearchEffectivenessUser withTrashed()
 * @method static \Illuminate\Database\Query\Builder|ScientificResearchEffectivenessUser withoutTrashed()
 */
	class ScientificResearchEffectivenessUser extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\StateGrantFund
 *
 * @property-read User $user
 * @property int $id
 * @property string $name
 * @property string|null $price
 * @property string $full_price
 * @property int $year
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int $user_id
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|\Spatie\MediaLibrary\MediaCollections\Models\Media[] $media
 * @property-read int|null $media_count
 * @method static \Illuminate\Database\Eloquent\Builder|StateGrantFund newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StateGrantFund newQuery()
 * @method static \Illuminate\Database\Query\Builder|StateGrantFund onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|StateGrantFund query()
 * @method static \Illuminate\Database\Eloquent\Builder|StateGrantFund whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StateGrantFund whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StateGrantFund whereFullPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StateGrantFund whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StateGrantFund whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StateGrantFund wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StateGrantFund whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StateGrantFund whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StateGrantFund whereYear($value)
 * @method static \Illuminate\Database\Query\Builder|StateGrantFund withTrashed()
 * @method static \Illuminate\Database\Query\Builder|StateGrantFund withoutTrashed()
 */
	class StateGrantFund extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property-read string $full_name
 * @property-read string $full_name_abbr
 * @property-read string $full_post
 * @property-read string $phone_formatted
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string|null $patronymic
 * @property string $username
 * @property string $password
 * @property string|null $birthdate
 * @property string|null $phone
 * @property int|null $faculty_id
 * @property int|null $department_id
 * @property string|null $post
 * @property string|null $email
 * @property string|null $email_verify_at
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\CopyrightProtectedVariousMaterialInformation[] $copyrightProtectedVariousMaterialInformation
 * @property-read int|null $copyright_protected_various_material_information_count
 * @property-read \App\Models\Department|null $department
 * @property-read \App\Models\Faculty|null $faculty
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|\Spatie\MediaLibrary\MediaCollections\Models\Media[] $media
 * @property-read int|null $media_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\OakScientificArticle[] $oakScientificArticles
 * @property-read int|null $oak_scientific_articles_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ObtainedIndustrialSamplePatent[] $obtainedIndustrialSamplePatent
 * @property-read int|null $obtained_industrial_sample_patent_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Permission[] $permissions
 * @property-read int|null $permissions_count
 * @property-read \Spatie\Permission\Models\Role|null $post_name
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Role[] $roles
 * @property-read int|null $roles_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ScientificArticleCitation[] $scientificArticleCitations
 * @property-read int|null $scientific_article_citations_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ScientificArticle[] $scientificArticles
 * @property-read int|null $scientific_articles_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ScientificResearchEffectiveness[] $scientificResearchEffectiveness
 * @property-read int|null $scientific_research_effectiveness_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Query\Builder|User onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|User permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User role($roles, $guard = null)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereBirthdate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDepartmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifyAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereFacultyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePatronymic($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUsername($value)
 * @method static \Illuminate\Database\Query\Builder|User withTrashed()
 * @method static \Illuminate\Database\Query\Builder|User withoutTrashed()
 */
	class User extends \Eloquent implements \Spatie\MediaLibrary\HasMedia {}
}

