<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('history.index', [
            'pesanans' => Pesanan::where('user_id', auth()->user()->id)->where('status', '!=', 0)->get()
        ]);
    }

    public function show(Pesanan $pesanan)
    {
        return view('history.show', [
            'pesanan' => $pesanan
        ]);
    }
}
