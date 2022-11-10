<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'pseudo',
        'email',
        'password',
        'pseudo',
        'role',
        'country',
        'logo',
        'isAgreedWithTerms',
        'wishNewsletter',
        'enterprise_name',
        'enterprise_description',
        'neph_number',
        'juridique_status',
        'bilan_enterprise',
        'adresse',
        'phone_number',
        'iban',
        'identity_card',
        'investor_username',
        'source_of_income',
        'user_profession',
        'nationality',
        'genre',
        'birthday_date',
        'residence_country',
        'city',
        'home_justificatif',
        'relation_to_call_name',
        'relation_to_call_adress',
        'relation_to_call_phoneNumber',
        'bank_account_owner_name',
        'bank_account_owner_lastName',
        'bank_account_name',
        'source_of_income_justificatif'
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

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public function medias()
    {
        return $this->morphOne(Medias::class, 'mediable');
    }
    /**
     * Add user relation to retrieve all user project liked 
     */

    public function project_liked()
    {
        return $this->hasMany(ProjectLikes::class, 'like_by');
    }

    /**
     * Get User Attributs
     */
    public function getFillables()
    {
        return $this->fillable;
    }

    /**
     * Morph To favorites Entreprises
     */
    public function enterprisesLiked()
    {
        return $this->morphOne(Favorites::class, 'favoritable');
    }
}
