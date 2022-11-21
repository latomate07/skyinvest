<?php 
namespace App\Traits;

use App\Http\Requests\StoreLogoRequest;
use App\Models\User;
use App\Models\Medias;
use Illuminate\Http\Request;

trait DashboardTrait
{
    /**
     * Ajax controller
     */
    public function liveChange(StoreLogoRequest $request)
    {
        $user = User::find(auth()->user()->id);
        if($request->has('user_logo'))
        {
            $path = $request->user_logo->store('/', ['disk' => 'user_logo_path']);
            $user->medias()->updateOrCreate([
                'mediable_id' => $user->id,
                'mediable_type' => User::class
            ], [
                'url' => $path
            ]);
        }
        $data = [
            'user' => auth()->user(),
            'path_logo' => $path ?? 'Non défini',
            'success' => 'Votre photo de profil a été mis à jour avec succès'
        ];
        return response()->json($data);
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
            $user->update(['isReadyToInvest' => 1]);
            return true;
        }

        return false;
    }

     /**
     * Check if enterprise is ready to publish project
     */
    public static function isReadyToPublish() : bool
    {
        return false;
    }
}


