<?php

namespace App\Http\Controllers;

use App\User;
use App\Message;
use App\Personal;
use Inertia\Inertia;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return bool|Application|Factory|View|Void
     */
    public function index()
    {
        $users = User::paginate(3);
        $userID = Auth::id();
        $personalData = DB::select("SELECT * FROM personals WHERE user_id = " . $userID);
        $companyData = DB::select("SELECT * FROM companies WHERE user_id = " . $userID);
        $advertisements = DB::select("SELECT * FROM advertisements WHERE user_id = " . $userID);

        if (Auth::check()) {
            if (Auth::user()->is_admin === 1) {
                return \view('admin.index')->with('users', $users);
            }

            if (Auth::user()->is_admin === 0 && Auth::user()->is_company === 1 && Auth::user()->is_active === 1) {
                if ($companyData) {
                    return \view('company.admin')->with([
                        'companyData' => $companyData,
                        'advertisements' => $advertisements,
                    ]);
                }

                return \view('company.index');
            }

            if (Auth::user()->is_admin === 0 && Auth::user()->is_company === 0 && Auth::user()->is_active === 1) {
                if ($personalData) {
                    return \view('user.admin')->with([
                        'personalData' => $personalData,
                        'advertisements' => $advertisements,
                    ]);
                }

                return \view('user.index');
            }

            return view('error.index');
        }
    }

    public function updatePersonalData(Personal $personals)
    {
        // $personalProp = DB::select("SELECT * FROM personals WHERE user_id = ".$id);
        return Inertia::render('User/UserUpdate', [
            'personal-prop' => $personals
        ]);
    }

    public function sendResponse(Message $message, $id)
    {
        // $message = new Message();
        // $message->name = Auth::user();
        // $message->sender_id = Auth::id();
        // $message->receiver_id = $request->input('receiver_id');
        // $message->message = $request->input('message');
        // $message->save();
        // return back()->with("Enregistrement reusi");
    }

    public function show()
    {
        return view('/chat');
    }
}
