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


