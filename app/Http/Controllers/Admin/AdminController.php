<?php

namespace App\Http\Controllers\Admin;

use App\Company;
use App\Http\Controllers\Controller;
use App\Personal;
use App\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class AdminController extends Controller {

	public $users;

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware('auth');
		$this->users = User::getAllUsers();
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response|Application|Factory|RedirectResponse|View
	 */
	public function index() {
		if (Auth::check()) {
			if (Auth::user()->is_admin === 1) {
				$users = User::paginate(3);
				$personals = Personal::all();
				return view('admin.index')->with([
					'users' => $users,
					'personals' => $personals
				]);
			}

            return back();
        }

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View
     */
	public function show(int $id) {
		if (Auth::user()->is_admin === 1) {
			$userID = DB::select("SELECT * FROM users WHERE id = " . $id);
			$personal_id = DB::select("SELECT * FROM personals WHERE user_id = " . $id);
			$company_id = DB::select("SELECT * FROM companies WHERE user_id = " . $id);
			$advertisements = DB::select("SELECT * FROM advertisements WHERE user_id = " . $id);

			if ($personal_id) {
				return view('admin.user')->with([
					'userID' => $userID,
					'personal_id' => $personal_id,
					'advertisements' => $advertisements,
				]);
			} elseif ($company_id) {
				return \view('admin.company')->with([
					'userID' => $userID,
					'company_id' => $company_id,
					'advertisements' => $advertisements,
				]);
			} else {
				return back();
			}

		} else {
			return back();
		}

	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param int $id
	 * @return View
	 */
	public function create(int $id){

	}

	/**
	 * Show the form for editing the specified resource.
	 * @param int $id
	 * @return View
	 */
	public function edit(int $id) {
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param int $id
	 * @return RedirectResponse|Response
	 */
	public function update(int $id) {
		DB::update('UPDATE users SET is_active = 1 WHERE id = ' . $id);
		return back();
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param int $id
	 * @return RedirectResponse|Response
	 */
	public function makeactive(int $id) {
		DB::update('UPDATE users SET is_active = 1 WHERE id = ' . $id);
		return back();
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param User $user
	 * @param int $id
	 * @return RedirectResponse|Response
	 */
	public function makeunactive(User $user, int $id) {
		DB::update('UPDATE users SET is_active = 0 WHERE id = ' . $id);
		$message = "L'utilisateur <span class='badge badge-danger'>$user->name</span> a ete bien desactiver";
		return back();
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @param int $id
	 * @return RedirectResponse|Response
	 */
	public function destroy(int $id) {
		if ($id) {
			DB::delete('DELETE FROM users WHERE id = ' . $id);
			return back();
		}
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Application|Factory|View
	 */
	public function showCompany() {
		$companies = Company::paginate(7);
		return \view('admin.companies')->with('companies', $companies);
	}

	/**
	 * Show User personal information
	 *
	 * @return Application|Factory|View
	 */
	public function showUser() {
		$personals = DB::select("SELECT * FROM personals INNER JOIN users WHERE users.id = personals.user_id");
		return \view('admin.personals')->with([
			'personals' => $personals,
		]);
	}

	/**
	 * CONTROLLER FOR DELETING USER POST
	 *
	 * @return Application|Factory|View
	 */
	public function deleteUserPost(int $id) {
		DB::delete("DELETE FROM advertisements WHERE id =" . $id);
		return back();
    }

    /**
	 * Show the form for creating a new resource.
	 *
	 * @return Application|Factory|View
	 */
    public function showContactMessage()
    {
        $messages = DB::select("SELECT * FROM contacts");

        return view('contact.index')->with('messages', $messages);
	}
}
