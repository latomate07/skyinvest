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

    /**
     * Check if investissor is ready to invest
     */
    public static function isReadyToInvest(int $id) : bool
    {
        $user = User::find($id);
        if($user->role !== 'Investisseur')
        {
            return false;
        }
        $required_informations = [
            'adresse' => $user->adresse,
            'iban' => $user->iban,
            'investor_username' => $user->investor_username,
            'source_of_income' => $user->source_of_income,
            'nationality' => $user->nationality,
            'genre' => $user->genre,
            'birthday_date' => $user->birthday_date,
            'residence_country' => $user->residence_country,
            'city' => $user->city,
            // 'home_justificatif',
            'relation_to_call_name' => $user->relation_to_call_name,
            'relation_to_call_adress' => $user->relation_to_call_adress,
            'relation_to_call_phoneNumber' => $user->relation_to_call_phoneNumber,
            'bank_account_owner_name' => $user->bank_account_owner_name,
            'bank_account_owner_lastName' => $user->bank_account_owner_lastName,
            'bank_account_name' => $user->bank_account_name,
            'source_of_income_justificatif' => $user->source_of_income_justificatif,
            // 'source_of_income'
        ];

        foreach($required_informations as $key => $value)
        {
            if(is_null($value))
            {
                return false;
            }
            return true;
        }

        return false;
    }

     /**
     * Check if enterprise is ready to publish project
     */
    public static function isReadyToPublish(int $id) : bool
    {
        $user = User::find($id);
        if($user->role !== 'Entreprise')
        {
            return false;
        }
        $required_informations = [
            'adresse' => $user->adresse,
            'iban' => $user->iban,
            'enterprise_name' => $user->enterprise_name,
            'enterprise_description' => $user->enterprise_description,
            'neph_number' => $user->neph_number,
            'juridique_status' => $user->juridique_status,
            'bilan_enterprise' => $user->bilan_enterprise,
            'source_of_income' => $user->source_of_income,
            'nationality' => $user->nationality,
            'genre' => $user->genre,
            'residence_country' => $user->residence_country,
            'city' => $user->city,
            'relation_to_call_name' => $user->relation_to_call_name,
            'relation_to_call_adress' => $user->relation_to_call_adress,
            'relation_to_call_phoneNumber' => $user->relation_to_call_phoneNumber,
            'bank_account_owner_name' => $user->bank_account_owner_name,
            'bank_account_owner_lastName' => $user->bank_account_owner_lastName,
            'bank_account_name' => $user->bank_account_name,
            'source_of_income_justificatif' => $user->source_of_income_justificatif,
        ];

        foreach($required_informations as $key => $value)
        {
            if(is_null($value))
            {
                return false;
            }
            return true;
        }

        return false;
    }
}
