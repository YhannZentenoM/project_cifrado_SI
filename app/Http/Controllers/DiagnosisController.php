<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Diagnosis;
use Illuminate\Support\Facades\Hash;

class DiagnosisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
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
        $data = [
            'id_patient' => $request->input('patient'),
            'diagnosis' => $request->input('diagnosis'),
            'prescription' => $request->input('prescription'),
        ];
        $keypublica = \openssl_pkey_get_public(\file_get_contents('./publica.key'));
        \openssl_public_encrypt(\json_encode($data), $datos_cifrados, $keypublica);

        //DESCIFRAR
        // $keyprivada = \openssl_pkey_get_private(\file_get_contents('./privada.key'));
        // openssl_private_decrypt($datos_cifrados, $datos_descifrados, $keyprivada);
        // echo $r = Hash::make($datos_cifrados);
        $d = new Diagnosis();
        $d->diagnosis = base64_encode($datos_cifrados);
        $d->save();

        return \redirect()->route('home');
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
