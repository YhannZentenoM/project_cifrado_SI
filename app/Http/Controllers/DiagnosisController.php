<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Diagnosis;
use Illuminate\Support\Facades\Hash;

class DiagnosisController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $diagnosis = Diagnosis::get();
        $array_diagnosis = [];
        if(!empty($diagnosis)){
            foreach ($diagnosis as $value) {
                $response = DesencriptarTexto(base64_decode($value->diagnosis), base64_decode($value->private_key), $value->module);
                array_push($array_diagnosis, json_decode($response));
            }
        }
        return view('home', ['diagnosis' => $array_diagnosis]);
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
        // $rsa = new RSA();
        $keys = GenerarClaves();
        $e = $keys['publica'];
        $p = $keys['privada'];
        $m = $keys['modulo'];

        // echo $e."---".$d."----".$m;
        $data = [
            'id_patient' => $request->input('patient'),
            'diagnosis' => $request->input('diagnosis'),
            'prescription' => $request->input('prescription'),
        ];
        $datos_cifrados = EncriptarTexto(\json_encode($data), $e, $m);
        // $keypublica = \openssl_pkey_get_public(\file_get_contents('./publica.key'));
        // \openssl_public_encrypt(\json_encode($data), $datos_cifrados, $keypublica);

        //DESCIFRAR
        // $keyprivada = \openssl_pkey_get_private(\file_get_contents('./privada.key'));
        // openssl_private_decrypt($datos_cifrados, $datos_descifrados, $keyprivada);
        // echo $r = Hash::make($datos_cifrados);

        // echo $datos_cifrados."<br>";
        // echo DesencriptarTexto($datos_cifrados, $d, $m);
        
        $d = new Diagnosis();
        $d->diagnosis = base64_encode($datos_cifrados);
        $d->private_key = base64_encode($p);
        $d->module = $m;
        $d->save();

        return \redirect()->route('diagnosis.home');
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
