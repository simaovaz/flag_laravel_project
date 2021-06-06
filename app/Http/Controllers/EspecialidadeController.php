<?php

namespace App\Http\Controllers;

use App\Models\Especialidade;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Validator;

class EspecialidadeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('especialidades.index', ['especialidades' => Especialidade::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('especialidades.create');
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

        if($validator->fails()){
            return redirect()->route('especialidades.index')->withErrors($validator->errors());
        }

        $especialidade = new Especialidade();
        $especialidade->name = $input['name'];
        $especialidade->save();

        return redirect()->route('especialidades.index')->with("message", "Especialidade $especialidade->name inserida com sucesso!");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Especialidade  $especialidade
     * @return \Illuminate\Http\Response
     */
    public function show(Especialidade $especialidade)
    {
        return view('especialidades.show', ["especialidade" => $especialidade]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Especialidade  $especialidade
     * @return \Illuminate\Http\Response
     */
    public function edit(Especialidade $especialidade)
    {
        return view('especialidades.edit', ["especialidades" => $especialidade]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Especialidade  $especialidade
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Especialidade $especialidade)
    {
        $input = $request->all();
        $validator = $this->validateInputs($input);

        if($validator->fails()){
            return redirect()->route('medicos.edit', $especialidade->id)->withErrors($validator->errors());
        }

        $especialidade->name = $input['name'];
        try{
            $especialidade->save();
        }catch(Exception $e){
            return redirect()->route('especialidades.index')->withErrors("Ocorreu um erro!");
        }


        return redirect()->route('especialidades.index')->with("message", "Especialidade $especialidade->name editada com sucesso!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Especialidade  $especialidade
     * @return \Illuminate\Http\Response
     */
    public function destroy(Especialidade $especialidade)
    {
        //$especialidade->delete();
        Especialidade::destroy($especialidade->id);
        return redirect()->route('especialidades.index')->with('message', "Especialidade eliminada com sucesso!");
    }

    private function validateInputs($input){

        $rules = [
            'name' => 'required'
        ];

        return Validator::make($input, $rules);
    }
}
