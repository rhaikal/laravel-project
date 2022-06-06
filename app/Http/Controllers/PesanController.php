<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Barang;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use App\Models\PesananDetail;
use RealRashid\SweetAlert\Facades\Alert;

class PesanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show(Barang $barang)
    {
        return view('pesan.show' ,[
            'barang' => $barang
        ]);
    }

    public function order(Request $request)
    {
        $validatedData = $request->validate([
            'quantity' => "required|numeric|max:$request->stock"
        ]);

        $pesanan = Pesanan::where('user_id', auth()->user()->id)->where('status', 0)->first();
        
        if(empty($pesanan)){
            $pesanan = Pesanan::create([
                'user_id' => auth()->user()->id, 
                'ordered_at' => today(),
                'status' => 0,
                'code' => $this->generateUniqueCode(),
                'total_price' => 0
            ]);
        }

        $pesananDetail = $pesanan->pesananDetail()->where('barang_id', $request->barang_id)->first();

        if(empty($pesananDetail)){
            $pesananDetail = PesananDetail::create([
                'barang_id' => $request->barang_id,
                'pesanan_id' => $pesanan->id,
                'amount' => $validatedData['quantity'],
                'total_price' => $request->price * $validatedData['quantity']
            ]);
            
        } else {
            $pesananDetail->update([
                'amount' => $pesananDetail->amount + $validatedData['quantity'],
                'total_price' => $pesananDetail->total_price + $request->price * $validatedData['quantity']
            ]);
        }

        $pesanan->update([
            'total_price' => $pesanan->total_price + $request->price * $validatedData['quantity']
        ]);

        // Barang::where('id', $request->barang_id)
        // ->update(['stock' => $request->stock - $validatedData['quantity']]);

        Alert::success('Success', 'Pesanan Berhasil Ditambahkan')->persistent(false, false)->autoClose(3000);
        return redirect('/home');
    }

    public function checkOut()
    {
        return view('pesan.checkout', [
            'pesanan' => Pesanan::where('user_id', auth()->user()->id)->where('status', 0)->first()
        ]);
    }

    public function destroy(PesananDetail $pesananDetail)
    {
        $pesanan = Pesanan::find($pesananDetail->pesanan_id);
        
        $pesanan->update([
            'total_price' => $pesanan->total_price - $pesananDetail->total_price
        ]);
        
        if($pesanan->ordered_at !== today()){
            $pesanan->update([
                'ordered_at' => today()
            ]);
        }

        PesananDetail::destroy($pesananDetail->id);
        
        Alert::success('Success', 'Pesanan Berhasil Dihapus')->persistent(false, false)->autoClose(3000);
        return redirect('/pesan/checkout');
    }

    public function confirm()
    {
        $user = User::find(auth()->user()->id);
        
        if(empty($user->address) || empty($user->phone_number)){
            Alert::error('Error', 'Identitas harap dilengkapi')->persistent(false, false)->autoClose(3000);
            return redirect('/pesan/checkout');
        }

        $pesanan = Pesanan::where('user_id', auth()->user()->id)->where('status', 0)->first();
        $pesanan->update([
            'status' => 1
        ]);

        $pesananDetails = $pesanan->pesananDetail()->get();
        foreach($pesananDetails as $pesananDetail)
        {
            $barang = $pesananDetail->barang()->first();
            $barang->update([
                'stock' => $barang->stock - $pesananDetail->amount
            ]);
        }

        Alert::success('Success', 'Pesanan Berhasil Dikonfirmasi')->persistent(false, false)->autoClose(3000);
        return redirect("/history/$pesanan->code");
    }

    private function generateUniqueCode()
    {
        $number =  mt_rand(100, 999);
        
        if ($this->uniqueCodeExists($number)) {
            return $this->generateUniqueCode();
        }

        return $number;
    }

    private function uniqueCodeExists($number) 
    {
        return Pesanan::where('code', $number)->exists();
    }
}
