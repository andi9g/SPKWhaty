<?php

namespace App\Http\Controllers;

use App\Models\satuanM;
use Illuminate\Http\Request;

class satuanC extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $satuan = satuanM::get();
        return view('pages.pagessatuan', [
            'satuan' => $satuan,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'satuan'=>'namasatuan'
        ]);

        try{
            $data = $request->all();

            satuanM::create($data);

            return redirect('satuan')->with('toast_success', 'Success');

        }catch(\Throwable $th){
            return redirect('satuan')->with('toast_error', 'Terjadi kesalahan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\satuanM  $satuanM
     * @return \Illuminate\Http\Response
     */
    public function show(satuanM $satuanM)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\satuanM  $satuanM
     * @return \Illuminate\Http\Response
     */
    public function edit(satuanM $satuanM)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\satuanM  $satuanM
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, satuanM $satuanM, $idsatuan)
    {
        $request->validate([
            'satuan'=>'namasatuan'
        ]);

        try{
            $data = $request->all();
            $ubah = $satuanM::where('idsatuan', $idsatuan)->first();
            $ubah->update($data);
            return redirect('satuan')->with('toast_success', 'Success');

        }catch(\Throwable $th){
            return redirect('satuan')->with('toast_error', 'Terjadi kesalahan');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\satuanM  $satuanM
     * @return \Illuminate\Http\Response
     */
    public function destroy(satuanM $satuanM, $idsatuan)
    {
        try{
            $satuanM->destroy($idsatuan);
            return redirect('satuan')->with('toast_success', 'Success');

        }catch(\Throwable $th){
            return redirect('satuan')->with('toast_error', 'Terjadi kesalahan');
        }
    }
}
