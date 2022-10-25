<?php 
namespace App\Traits;

use App\Models\User;
use App\Models\Medias;
use Illuminate\Http\Request;

trait DashboardTrait
{
    /**
     * Ajax controller
     */
    public function liveChange(Request $request)
    {
        // dd($request->all());
        $media = new Medias();

        if($request->has('user_logo'))
        {
            $path = $request->user_logo->store('/', ['disk' => 'user_logo_path']);
            $media->url = $path;
            $media->save();
        }
        $data = [
            'user' => auth()->user(),
            'path_logo' => $path ?? 'Non défini',
            'success' => 'Votre photo de profil a été mis à jour avec succès'
        ];
        return response()->json($data);
    }

    /**
     * Update user informations
     */
    public function storeSupplementUserInformation(Request $request)
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
     * Check if investissor is ready to invest
     */
    public function isReadyToInvest() : bool
    {
    }

     /**
     * Check if enterprise is ready to publish project
     */
    public function isReadyToPublish() : bool
    {
    }
}


