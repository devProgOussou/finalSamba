<?php

namespace App\Http\Controllers\User;

use App\Advertisements;
use App\Category;
use App\Company;
use App\Contact;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdvertisementRequest;
use App\Http\Requests\CategoriesRequest;
use App\Http\Requests\CompanyRequest;
use App\Http\Requests\ContactRequest;
use App\Http\Requests\MessageRequest;
use App\Http\Requests\PersonalRequest;
use App\Message;
use App\Personal;
use App\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Inertia\Inertia;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|Void
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

            return view('error.error');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View|void
     */
    public function advertisementMaker()
    {
        return \view('user.post');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create(): void
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param $id
     * @return void
     */
    public function store($id): void
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View|void
     */
    public function show(int $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return void
     */
    public function edit(int $id): void
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PersonalRequest $request
     * @param int $id
     * @return Response
     */
    public function update(Personal $personals, $id)
    {
        dd($personals);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Void
     */
    public function destroy(int $id): void
    {
        //
    }

    /**
     * User register
     *
     * @param PersonalRequest $request
     * @return Application|Factory|View
     */
    public function userRegister(PersonalRequest $request)
    {
        $advertisements = DB::select("SELECT * FROM advertisements WHERE user_id = " . Auth::id());
        $personal = new Personal();
        $personal->is_company = $request->input('is_company');

        $company = new Company();
        $company->is_company = $request->input('is_company');
        if ($personal->is_company == 1) {
            DB::update('UPDATE users SET is_company = 1 WHERE id = ' . Auth::id());
            $company = new Company();
            $company->civility = $request->input('civility');
            $company->name = $request->input('name');
            $company->company = $request->input('company');
            $company->address = $request->input('address');
            $company->phone = $request->input('phone');
            $company->user_id = Auth::id();
            $company->save();
            return view('company.admin')->with([
                'advertisements' => $advertisements,
            ]);
        } 
        elseif($company->is_company == 0) {
            $personalData = new Personal();
            $personalData->civility = $request->input('civility');
            $personalData->name = $request->input('name');
            $personalData->address = $request->input('address');
            $personalData->phone = $request->input('phone');
            $personalData->user_id = Auth::id();
            $personalData->save();

            return \view('user.admin')->with([
                'advertisements' => $advertisements,
            ]);
        }
        else {
            return back();
        }
    }

    /**
     * Company register
     *
     * @param CompanyRequest $request
     * @return Application|Factory|View|void
     */
    public function CompanyRegister(CompanyRequest $request)
    {
        $company = new Company();
        $company->civility = $request->input('civility');
        $company->name = $request->input('name');
        $company->company = $request->input('company');
        $company->addressCompany = $request->input('addressCompany');
        $company->phone = $request->input('phone');
        $company->user_id = $request->input('user_id');
        $company->save();

        $advertisements = DB::select("SELECT * FROM advertisements WHERE user_id = " . Auth::id());
        return \view('company.admin')->with([
            'advertisements' => $advertisements,
        ]);
    }

    /**
     * Personal Update
     *
     * @param PersonalRequest $request
     * @param $id
     * @return Application|Factory|View|void
     */
    public function updatePersonalData(PersonalRequest $request, $id)
    {
        $personalProp = Personal::all()->where('user', Auth::id());
        return Inertia::render('User/UserUpdate', [
            'personal-prop' => $personalProp,
        ]);
    }

    /**
     * Add advertisement
     *
     * @param AdvertisementRequest $request
     * @return Application|Factory|RedirectResponse|View|void
     */
    public function makeAdvertisement(AdvertisementRequest $request, CategoriesRequest $requestCategories)
    {
        $advertisement = new Advertisements();
        $advertisement->name = $request->input('name');
        $advertisement->description = $request->input('description');
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/', $filename);
            $advertisement->image = $filename;
        } else {
            return back();
        }
        $advertisement->user_id = $request->input('user_id');
        $advertisement->save();

        $category = new Category();
        $category->categories = $requestCategories->input("categories");
        $category->user_id = $requestCategories->input("user_id");
        $category->save();

        $advertisements = Advertisements::all()->where('user_id', '=', Auth::id());
        $user = Personal::all()->where('user_id', '=', Auth::id());
        if ($user) {
            return \view('user.post')->with(
                'advertisements', $advertisements
            );
        } else {
            return \view('company.admin')->with(
                'advertisements', $advertisements
            );
        }
    }

    /**
     * Annonce view/Home
     * @return Application|Factory|View
     */
    public function annonce()
    {
        $annonces = Advertisements::paginate(2);
        return view('annonces')->with('annonces', $annonces);
    }

    /**
     * myAdvertisements
     * Annonce view/Home
     * @return Application|Factory|View
     */
    public function myAdvertisements()
    {
        $advertisements = Advertisements::all()->where('user_id', '=', Auth::id());
        return view('user.post')->with('advertisements', $advertisements);
    }

    /**
     * submitContact
     * @return RedirectResponse
     */
    public function submitContact(ContactRequest $request)
    {
        $contact = new Contact();
        $contact->firstName = $request->input('firstName');
        $contact->email = $request->input('email');
        $contact->object = $request->input('object');
        $contact->message = $request->input('message');
        $contact->is_user = $request->input('is_user');

        $contact->save();
        return back();
    }

    /**
     * Archiver
     * @param int $id
     * @return RedirectResponse
     */

    public function makeArchive(int $id): RedirectResponse
    {
        DB::select("UPDATE advertisements SET is_available = 0 WHERE id =" . $id);
        return back();
    }

    /**
     * Desarchiver
     * @param int $id
     * @return RedirectResponse
     */

    public function makeDearchive(int $id): RedirectResponse
    {
        DB::select("UPDATE advertisements SET is_available = 1 WHERE id =" . $id);
        return redirect()->route('home');
    }

    /**
     * @return Application|Factory|View|void
     */
    public function showMessage()
    {
        $messages = DB::select("SELECT * FROM messages WHERE receiver_id = " . Auth::id());
        // $messages = DB::table('messages')->orderBy('id')->where('receiver_id', '=', Auth::id());
        // $userSender = DB::selectOne("SELECT name FROM users INNER JOIN messages WHERE users.id = messages.sender_id");

        // dd($userSender);

        return view('chat')->with([
            'messages' => $messages,
        ]);
    }

    /**
     * @param MessageRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function sendMessage(MessageRequest $request, int $id): RedirectResponse
    {
        $message = new Message();
        $message->name = $request->input('name');
        $message->sender_id = $request->input('sender_id');
        $message->receiver_id = $request->input('receiver_id');
        $message->message = $request->input('message');
        $message->userReceive = $request->input('userReceive');
        $message->save();
        return back();
    }

    /**
     * @param int $id
     * @return Application|Factory|View|void
     */
    public function deleteMessage(int $id)
    {
        DB::delete('DELETE FROM messages where id = ' . $id);
        return back();
    }
}
