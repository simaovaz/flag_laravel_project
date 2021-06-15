<?php

namespace App\Http\Controllers;

use App\Models\Especialidade;
use App\Models\Medico;
use App\Models\Speciality;
use Exception;
use Illuminate\Database\QueryException;
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
        return view("medicos.create", ["especialidades" => Especialidade::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = $this->validateInputs($input);
        $input['photo'] = $this->saveFoto($request, uniqid());

        if($validator->fails()){
            return redirect()->route('medicos.index')->withErrors($validator->errors());
        }

        //$medico = new Medico($input);
        $medico = $this->fillMedico(new Medico(), $input);
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
        return view('medicos.edit', ["medico" => $medico, "especialidades" => Especialidade::all()]);
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

        $medico = $this->fillMedico($medico, $input);
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
            'phone' => 'required|numeric|digits:9',
            'especialidade' => 'numeric'
        ];

        return Validator::make($input, $rules);
    }


    private function fillMedico(Medico $medico, array $input) : Medico
    {
        $medico->name = $input['name'];
        $medico->address = $input['address'];
        $medico->phone = $input['phone'];
        $medico->speciality_id = $input['especialidade'];
        if(isset($input['photo'])){
            $medico->photo = $input['photo'];
        }
        return $medico;
    }
    private function saveFoto($request, $name){
        if ($request->hasFile('photo')) {
            if ($request->file('photo')->isValid()) {
                $file = $request->file('photo');
                $extension = $file->extension();
                $file->storeAs('public', $name.".".$extension);
                return $name.".".$extension;
            }
            //throw new Exception('Uploaded file not a valid image');
        }
        return null;
    }
}
