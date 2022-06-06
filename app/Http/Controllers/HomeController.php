<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Pesanan;
use \NumberFormatter;    
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home', [
            'barangs' => Barang::paginate(20),
            'pesanan' => Pesanan::where('user_id', Auth::user()->id)->where('status',0)->first()
        ]);
    }
}
