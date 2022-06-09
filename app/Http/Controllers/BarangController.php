<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.barang.index', [
            'barangs' => Barang::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.barang.create', [
            'barangs' => Barang::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $price = explode(' ' , $request['price']);
        $request['price'] = str_replace('.', '', $price[1]);
        $validatedData = $request->validate([
            'image' => 'nullable|image|file|max:1024',
            'item_name' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required',
            'size' => 'required'
        ]);

        if($request->file('image')){
            $validatedData['image'] = $request->file('image')->store('barang-image');
        }

        Barang::create($validatedData);
        
        Alert::success('Success', 'Barang Berhasil Dibuat')->persistent(false, false)->autoClose(3000);
        return redirect('/dashboard/barangs');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function show(Barang $barang)
    {
        return view('dashboard.barang.show', [
            'barang' => $barang
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function edit(Barang $barang)
    {
        return view('dashboard.barang.edit', [
            'barang' => $barang
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Barang $barang)
    {
        $price = explode(' ' , $request['price']);
        $request['price'] = str_replace('.', '', $price[1]);
        $validatedData = $request->validate([
            'image' => 'nullable',
            'item_name' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required',
            'size' => 'required'
        ]);

        $barang->update($validatedData);

        Alert::success('Success', 'Barang Berhasil Diedit')->persistent(false, false)->autoClose(3000);
        return redirect('/dashboard/barangs');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function destroy(Barang $barang)
    {
        $barang->delete();

        Alert::success('Success', 'Barang Berhasil Dihapus')->persistent(false, false)->autoClose(3000);
        return redirect('/dashboard/barangs');
    }
}
