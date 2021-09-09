<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Plano;
use Illuminate\Http\Request;

class PlanoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $planos = Plano::orderBy('created_at', 'DESC')->paginate(25);
        return view('admin.planos.index',[
            'planos' => $planos
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.planos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $criarPlano = Plano::create($request->all());
        $criarPlano->fill($request->all());

        $criarPlano->setSlug();
        
        return redirect()->route('admin.planos.edit', [
            'plano' => $criarPlano->id,
        ])->with(['color' => 'success', 'message' => 'Plano cadastrado com sucesso!']);
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
        $plano = Plano::where('id', $id)->first();

        return view('admin.planos.edit',[
            'plano' => $plano
        ]);
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
        $plano = Plano::where('id', $id)->first();
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
