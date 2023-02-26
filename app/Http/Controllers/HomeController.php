<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Project;
use App\Models\ProjectLikes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $projects = Project::with([
                                'medias',
                                'user' => function($user) {
                                    $user->with('medias');
                                }
                            ])
                            ->when($request->has('need') && $request->need == 'recent', function($query) use($request) {
                                $query->orderBy('id', 'DESC');
                            })
                            ->get();
        // Get current user projects liked
        if($request->has('need') && $request->need == 'liked') {
            $projects = User::find(Auth::user()?->id)?->project_liked()->where('is_liked', 'yes')->get();
        }

        return Inertia::render('Home', [
            'isLogin'  => Auth::check(),
            'user'     => User::with('medias')->firstWhere('id', Auth::user()?->id),
            'projects' => fn() => $projects
        ]);
    }

    /**
     * Store user wish newsletter
     */
    public function isWishNewsletter(Request $request)
    {
        $user = User::find(auth()->user()->id);
        if(!is_null($request->userMail))
        {
            if($user->email !== $request->userMail)
            {
                $user->email = $request->userMail;
                $user->wishNewsletter = "on";
                $user->save();
            }
            $user->wishNewsletter = "on";
            $user->save();

            $data = [
                'user' => $user,
                'message' => 'Votre demande a bien été prise en compte.'
            ];
        }
        else {
            $data = [
                'user' => $user,
                'warning' => 'Vous devez indiqué votre mail.'
            ];
        }

        return response()->json($data);
    }
}
