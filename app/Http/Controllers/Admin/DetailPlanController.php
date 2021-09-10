<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DetailPlan as RequestsDetailPlan;
use App\Models\DetailPlan;
use App\Models\Plano;
use Illuminate\Http\Request;

class DetailPlanController extends Controller
{
    public function index($urlPlan)
    {
        $plano = Plano::where('slug', $urlPlan)->first();

        if(!$plano){
            return redirect()->back()->with(['color' => 'danger', 'message' => 'Operação Inválida!']);
        }

        $details = $plano->details()->paginate(15);

        return view('admin.planos.details.index',[
            'plano' => $plano,
            'details' => $details
        ]);
    }

    public function create($urlPlan)
    {
        $plano = Plano::where('slug', $urlPlan)->first();

        if(!$plano){
            return redirect()->back()->with(['color' => 'danger', 'message' => 'Operação Inválida!']);
        }

        return view('admin.planos.details.create',[
            'plano' => $plano
        ]);
    }

    public function store(RequestsDetailPlan $request, $urlPlan)
    {
        $plano = Plano::where('slug', $urlPlan)->first();        

        if(!$plano){
            return redirect()->back()->with(['color' => 'danger', 'message' => 'Operação Inválida!']);
        }

        $data = $request->all();
        $data['plano'] = $plano->id;
        $planocreate = DetailPlan::create($data);

        //$planocreate = $plano->details();
        //$planocreate->create($request->all()); Usando essa forma tem que voltar para a index        
        return redirect()->route('plan.details.edit', [
            'slug' => $plano->slug,            
            'id' => $planocreate->id
        ])->with(['color' => 'success', 'message' => 'Detalhe do Plano cadastrado com sucesso!']);
    }

    public function edit($urlPlan, $id)
    {        
        $plano = Plano::where('slug', $urlPlan)->first();
        $detalhe = DetailPlan::where('id', $id)->first();

        if(!$plano || !$detalhe){
            return redirect()->back()->with(['color' => 'danger', 'message' => 'Operação Inválida!']);
        }

        return view('admin.planos.details.edit',[
            'plano' => $plano,
            'detalhe' => $detalhe
        ]);
    }

    public function update(RequestsDetailPlan $request, $urlPlan, $id)
    {
        $plano = Plano::where('slug', $urlPlan)->first();
        $detalhe = DetailPlan::where('id', $id)->first();

        if(!$plano || !$detalhe){
            return redirect()->back()->with(['color' => 'danger', 'message' => 'Operação Inválida!']);
        }

        $detalhe->update($request->all());
        return redirect()->route('plan.details.edit', [
            'slug' => $plano->slug,
            'id' => $detalhe->id
        ])->with(['color' => 'success', 'message' => 'Detalhe do Plano foi Atualizado com sucesso!']);
    }

    public function delete(Request $request)
    {
        $detalhe = DetailPlan::where('id', $request->id)->first();
        $plano = Plano::where('id', $detalhe->plano)->first();
        if(!empty($detalhe)){
            $json = "Você tem certeza que deseja excluir este detalhe do Plano?";
            return response()->json([
                'error' => $json,
                'id' => $detalhe->id,
                'slug' => $plano->slug
            ]);
        }else{
            return response()->json([
                'success' => true,
                'id' => $detalhe->id,
                'slug' => $plano->slug
            ]);
        }
    }
    
    public function deleteon(Request $request)
    {
        $delete = DetailPlan::where('id', $request->detail_id)->first();
        $plano = Plano::where('id', $delete->plano)->first();        

        $detalheR = $delete->name;
        if(!empty($delete)){            
            $delete->delete();
        }
        return redirect()->route('plan.details.index',[
            'slug' => $plano->slug
        ])->with(['color' => 'success', 'message' => 'O detalhe '.$detalheR.' foi removido do plano com sucesso!']);
    }
}
