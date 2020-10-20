<?php

namespace App\Http\Controllers;

use App\User;
use App\Personal;
use Inertia\Inertia;
use App\Advertisements;
use Illuminate\Support\Facades\DB;

class AdvertisementController extends Controller
{
    public function annonce()
    {
        $annonces = Advertisements::all()->where('is_available', '=', 1);
        return view('annonces')->with('annonces', $annonces);
    }

    public function showDeal($id)
    {
        $commandes = DB::select("SELECT * FROM advertisements WHERE id = ".$id);
        return view('order.index')->with('commandes', $commandes);
        
    }
}
