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
    /****************** UPDATE USER INFORMATIONS *********************/
    /**
     * Update user informations - Step One
     */
    public function updateInfosStepOne(Request $request)
    {
        $user = User::findOrfail(auth()->user()->id);
        $data = [];
        foreach($request->except('_token') as $request_data)
        {
            array_push($data, $request_data);
        }
        $user_update = $user->update([
            // '' =>  $data[0]['userBirthCountry'],
            'birthday_date' =>  $data[0]['userBirthday'],
            'name' => $data[0]['userFullName'],
            'genre' => $data[0]['userGenre'],
            'nationality' => $data[0]['userNationality'],
            'residence_country' => $data[0]['userResidence']
        ]);
        $response = [
            'user' => auth()->user(),
            'message' => $user_update == true ? 'Vos informations ont bien été mis à jour.' : 'Une erreur a été produite'
        ];
        return response()->json($response, 200);
    }
    /**
     * Update user informations - Step Two
     */
    public function updateInfosStepTwo(Request $request)
    {
        $user = User::find(auth()->user()->id);
        $data = [];
        foreach($request->except('_token') as $request_data)
        {
            array_push($data, $request_data);
        }
        $user_update = $user->update([
            'adresse' =>  $data[0]['userAdress'],
            'city' => $data[0]['userCity'],
            'relation_to_call_name' => $data[0]['userFamilyName'],
            'relation_to_call_adress' => $data[0]['userFamilyAdress'],
            'relation_to_call_phoneNumber' => $data[0]['userFamilyTel']
        ]);
        $response = [
            'user' => auth()->user(),
            'message' => $user_update == true ? 'Vos informations ont bien été mis à jour.' : 'Une erreur a été produite'
        ];
        return response()->json($response, 200);
    }
    /**
     * Update user informations - Step Three
     */
    public function updateInfosStepThree(Request $request)
    {
        $user = User::findOrfail(auth()->user()->id);
        $data = [];
        foreach($request->except('_token') as $request_data)
        {
            array_push($data, $request_data);
        }
        $user_update = $user->update([
            'bank_account_owner_name' =>  $data[0]['bankOwnerName'],
            'bank_account_owner_lastName' => $data[0]['bankOwnerLastName'],
            'bank_account_name' => $data[0]['bankName'],
            'iban' => $data[0]['bankIban']
        ]);

        $response = [
            'user' => auth()->user(),
            'message' => $user_update == true ? 'Vos informations ont bien été mis à jour.' : 'Une erreur a été produite'
        ];
        return response()->json($response, 200);
    }
    /**
     * Update user informations - Step Fourth
     */
    public function updateInfosStepFourth(Request $request)
    {
        $user = User::findOrfail(auth()->user()->id);
        $data = [];
        foreach($request->except('_token') as $request_data)
        {
            array_push($data, $request_data);
        }
        $user_update = $user->update([
            'source_of_income_justificatif' =>  $data[0]['source_of_incomes_description'],
            // 'source_of_income' => $data[0]['userRevenues']
        ]);
        $response = [
            'user' => auth()->user(),
            'message' => $user_update == true ? 'Vos informations ont bien été mis à jour.' : 'Une erreur a été produite'
        ];
        return response()->json($response, 200);
    }
}


