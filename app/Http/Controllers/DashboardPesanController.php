<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Http\Request;
use App\Models\PesananDetail;
use RealRashid\SweetAlert\Facades\Alert;

class DashboardPesanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.pesan.index', [
            'pesanans' => Pesanan::where('status', '>=', 1)->get()
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pesanan  $pesanan
     * @return \Illuminate\Http\Response
     */
    public function show(Pesanan $pesanan)
    {
        return view('dashboard.pesan.show', [
            'pesanan' => $pesanan
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pesanan  $pesanan
     * @return \Illuminate\Http\Response
     */
    public function update(Pesanan $pesanan)
    {
        if ($pesanan->status == '1') 
        {
            $pesanan->update(['status' => '2']);
            Alert::success('Success', 'Berhasil Mengkonfirmasi Pesanan')->persistent(false, false)->autoClose(3000);
        }
        else
        {
            $pesanan->update(['status' => '1']);
            Alert::warning('Warning', 'Berhasil Menghapus Konfirmasi')->persistent(false, false)->autoClose(3000);    
        }

        return redirect('/dashboard/pesanans');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pesanan  $pesanan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pesanan $pesanan)
    {
        $pesananDetails = $pesanan->pesananDetail;
        
        if($pesanan->status == 1){
            foreach($pesananDetails as $pesananDetail)
            {
                $barang = $pesananDetail->barang;
                $barang->update([
                    'stock' => $barang->stock + $pesananDetail->amount
                ]);
            }
        }

        PesananDetail::destroy($pesananDetails->pluck('id'));

        $pesanan->delete();
        
        Alert::warning('Success', 'Berhasil Menghapus History Pemesanan')->persistent(false, false)->autoClose(3000);
        return redirect('/dashboard/pesanans');
    }
}
