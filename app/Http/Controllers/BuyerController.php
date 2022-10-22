<?php

namespace App\Http\Controllers;

use App\Http\Requests\BuyerStoreRequest;
use App\Models\Buyer;
use Illuminate\Http\Request;

class BuyerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $buyers = Buyer::all();
        return view('buyers.index', compact('buyers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $buyer = new Buyer();
        return view('buyers.create', compact('buyer'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BuyerStoreRequest $request)
    {
        try {
            $data = $request->all();

            Buyer::create($data);

            $result = ['status' => 'Success', 'color' => 'green', 'message' => 'Comprador ingresado satisfactoriamente'];
        } catch (\Throwable $e) {
            $result = ['status' => 'Error', 'color' => 'red', 'message' => 'Ocurrio un error inesperaro'];
        }
        return redirect()->route('buyers.index')->with($result);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Buyer $buyer)
    {
        return view('buyers.create', compact('buyer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BuyerStoreRequest $request, Buyer $buyer)
    {
        try {
            $data = $request->all();

            $buyer->fill($data);
            $buyer->save();

            $result = ['status' => 'Success', 'color' => 'blue', 'message' => 'Comprador actualizado satisfactoriamente.'];
        } catch (\Throwable $th) {
            $result = ['status' => 'Success', 'color' => 'red', 'message' => 'Ocurrio un error al actualizar el registro.'];
        }
        return redirect()->route('buyers.index')->with($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Buyer $buyer)
    {
        try {
            $buyer->delete();

            $result = ['status' => 'Success','color' =>'red', 'message' => 'Comprador eliminado satisfactoriamente'];
            
        } catch (\Throwable $e) {
            $result = ['status' => 'Error','color' =>'red', 'message' => 'Ocurrio un error al eliminar al comprador'];
        }
        return redirect()->route('buyers.index')->with($result);
    }
}
