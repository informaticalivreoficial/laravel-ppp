<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Plano as RequestsPlano;
use App\Models\DetailPlan;
use App\Models\Plano;
use Illuminate\Http\Request;

class PlanoController extends Controller
{
    
    public function index()
    {
        $planos = Plano::orderBy('created_at', 'DESC')->paginate();
        return view('admin.planos.index',[
            'planos' => $planos
        ]);
    }
    
    public function create()
    {
        return view('admin.planos.create');
    }
    
    public function store(RequestsPlano $request)
    {
        $criarPlano = Plano::create($request->all());
        $criarPlano->fill($request->all());

        $criarPlano->setSlug();
        
        return redirect()->route('planos.edit', [
            'plano' => $criarPlano->id,
        ])->with(['color' => 'success', 'message' => 'Plano cadastrado com sucesso!']);
    }
    
    public function show($id)
    {
        //
    }
    
    public function edit($id)
    {
        $plano = Plano::where('id', $id)->first();

        return view('admin.planos.edit',[
            'plano' => $plano
        ]);
    }
    
    public function update(RequestsPlano $request, $id)
    {
        $planoUpdate = Plano::where('id', $id)->first();
        $planoUpdate->fill($request->all());

        $planoUpdate->save();
        $planoUpdate->setSlug();        

        return redirect()->route('planos.edit', [
            'plano' => $planoUpdate->id,
        ])->with(['color' => 'success', 'message' => 'Plano atualizado com sucesso!']);
    }

    public function planoSetStatus(Request $request)
    {        
        $plano = Plano::find($request->id);
        $plano->status = $request->status;
        $plano->save();
        return response()->json(['success' => true]);
    } 
    
    public function search(Request $request)
    {
        $filters = $request->except('_token');
        $planos = Plano::where('name', 'LIKE', "%{$request->search}%")
                        ->orWhere('content', 'LIKE', "%{$request->search}%")
                        ->paginate();

        return view('admin.planos.index',[
            'planos' => $planos,
            'filters' => $filters
        ]);
    }

    public function delete(Request $request)
    {
        $plano = Plano::where('id', $request->id)->first();
        $detalhes = DetailPlan::where('plano', $request->id)->first();
        if(!empty($plano) && !empty($detalhes)){
            $json = "Você tem certeza que deseja excluir este Plano? Este plano possui detalhes e todos serão apagados!";
            return response()->json(['error' => $json,'id' => $plano->id]);
        }elseif(!empty($plano) && empty($detalhes)){
            $json = "Você tem certeza que deseja excluir este Plano?";
            return response()->json(['error' => $json,'id' => $plano->id]);
        }else{
            return response()->json([
                'success' => true,
                'id' => $plano->id
            ]);
        }
    }
    
    public function deleteon(Request $request)
    {
        $delete = Plano::where('id', $request->plano_id)->first(); 

        $detalhes = DetailPlan::where('plano', $request->plano_id)->first();  
        if(!empty($detalhes)){
            foreach($detalhes as $detail):
                $detail->delete();
            endforeach;
        }   

        $planoR = $delete->name;
        if(!empty($delete)){            
            $delete->delete();
        }
        return redirect()->route('planos.index')->with(['color' => 'success', 'message' => 'O plano '.$planoR.' foi removido com sucesso!']);
    }
}
