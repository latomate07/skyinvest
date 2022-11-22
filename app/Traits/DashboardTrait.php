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
}


