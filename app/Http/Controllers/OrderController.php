<?php

namespace App\Http\Controllers;

use App\Http\Requests\MessageRequest;
use App\Message;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Inertia\Inertia;

class OrderController extends Controller
{
    public function showDeal($id)
    {
        $commandes = DB::select("SELECT * FROM advertisements WHERE id = ".$id);
        return view('order.index')->with([
            'commandes' => $commandes
        ]);
    }

    /**
     * @param int $id
     * @return Application|Factory|View
     */
    public function makeOrder(int $id)
    {
        $idOrder = DB::select("SELECT user_id FROM advertisements WHERE id = ".$id);
        foreach ($idOrder as $orderID)
        {
            $orderID = $orderID->user_id;
        }
        $userPost = DB::select("SELECT * FROM users WHERE id = ".$orderID);
        $user = Auth::user();
        $order = DB::select("SELECT * FROM advertisements WHERE id = ".$id);
        return redirect()->route('show');
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
    public function showResponse(int $id)
    {
        dd($id);
    }


    /**
     * @param int $id
    //  * @param int $sender_id
     * @return Application|Factory|View|void
     */
    public function response($id)
    {
        $messages = DB::select("SELECT * FROM messages WHERE sender_id = ".$id);
         $userID = Auth::id();
        $messageSent = DB::select("SELECT * FROM messages INNER JOIN users WHERE messages.receiver_id = users.id AND users.id = $userID");
        $userReceiver = DB::select("SELECT * FROM users WHERE id = ".Auth::user()->id);
        return view('order.response')->with([
            'messages' => $messages,
            'userReceiver' => $userReceiver,
            'messageSent' => $messageSent
        ]);
        // dd($messageSent);
        // return Inertia::render('User/Chat', [
        //     'messages' => $messages,
        //     'userReceiver' => $userReceiver
        // ]);
    }

    /**
     * @param int $id
    //  * @param int $sender_id
     * @return Application|Factory|View|void
     */
    public function sendResponse(MessageRequest $request, $id)
    {
        $message = new Message();
        $message->name = $request->input('name');
        $message->sender_id = $request->input('sender_id');
        $message->receiver_id = $request->input('receiver_id');
        $message->message = $request->input('message');
        $message->userReceive = $request->input('userReceive');
        $message->save();
        return back()->with("Enregistrement reusi");
    }
}
