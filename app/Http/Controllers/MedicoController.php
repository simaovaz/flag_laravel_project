<?php

namespace App\Http\Controllers;

use App\Models\Medico;
use Exception;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MedicoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("medicos.index", ["medicos" => Medico::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("medicos.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //var_dump($request->get("name"));
        $input = $request->all();
        $validator = $this->validateInputs($input);

        if($validator->fails()){
            return redirect()->route('medicos.index')->withErrors($validator->errors());
        }

        //$medico = new Medico($input);
        $medico = new Medico();
        $medico->name = $input['name'];
        $medico->address = $input['address'];
        $medico->phone = $input['phone'];
        $medico->save();

        return redirect()->route('medicos.index')->with("message", "Médico $medico->id inserido com sucesso!");
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Medico  $medico
     * @return \Illuminate\Http\Response
     */
    public function show(Medico $medico)
    {
        return view('medicos.show', ["medico" => $medico]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Medico  $medico
     * @return \Illuminate\Http\Response
     */
    public function edit(Medico $medico)
    {
        return view('medicos.edit', ["medico" => $medico]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Medico  $medico
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Medico $medico)
    {
        $input = $request->all();
        $validator = $this->validateInputs($input);

        if($validator->fails()){
            return redirect()->route('medicos.edit', $medico->id)->withErrors($validator->errors());
        }

        $medico->name = $input['name'];
        $medico->address = $input['address'];
        $medico->phone = $input['phone'];
        try{
            $medico->save();
        }catch(Exception $e){
            return redirect()->route('medicos.index')->withErrors("Ocorreu um erro!");
        }


        return redirect()->route('medicos.index')->with("message", "Médico $medico->id editado com sucesso!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Medico  $medico
     * @return \Illuminate\Http\Response
     */
    public function destroy(Medico $medico)
    {
        //$medico->delete();
        Medico::destroy($medico->id);
        return redirect()->route('medicos.index')->with('message', "Médico eliminado com sucesso!");
    }

    private function validateInputs($input){

        $rules = [
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required|numeric|digits:9'
        ];

        return Validator::make($input, $rules);
    }
}
