<?php

namespace App\Http\Controllers\Client;

use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\DashboardTrait;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    use DashboardTrait;

    public function showDashboardPage(Request $request)
    {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);

        return view('client.dashboard.index', [
            'user' => $user,
            'isReadyToInvest' => User::isReadyToInvest($user_id),
            'isReadyToPublish' => User::isReadyToPublish($user_id)
        ]);
    }

        /**
     * Update user informations - Step One
     */
    public function investorStoreInfosStepOne(Request $request)
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
    public function investorStoreInfosStepTwo(Request $request)
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
    public function investorStoreInfosStepThree(Request $request)
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
    public function investorStoreInfosStepFourth(Request $request)
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
