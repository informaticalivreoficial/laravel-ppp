<?php

namespace App\Http\Controllers\ACL;

use App\Http\Controllers\Controller;
use App\Models\Perfil;
use App\Models\Plano;
use Illuminate\Http\Request;

class PlanoPerfilController extends Controller
{
    public function planos($id)
    {
        $plano = Plano::find($id);

        if(!$plano){
            return redirect()->back()->with(['color' => 'danger', 'message' => 'Operação Inválida!']);
        }

        $perfis = $plano->perfils()->paginate();

        return view('admin.planos.perfis.index',[
            'perfis' => $perfis,
            'plano' => $plano
        ]);
    }

    public function planosAvalible(Request $request, $id)
    {
        $plano = Plano::find($id);

        if(!$plano){
            return redirect()->back()->with(['color' => 'danger', 'message' => 'Operação Inválida!']);
        }

        $filters = $request->except('_token');

        $perfis = $plano->perfisAvailable($request->filter);

        return view('admin.planos.perfis.available', compact('plano', 'perfis', 'filters'));
    }


    public function attachPlanoPerfil(Request $request, $id)
    {
        $plano = Plano::find($id);

        if(!$plano){
            return redirect()->back()->with(['color' => 'danger', 'message' => 'Operação Inválida!']);
        }

        if (!$request->perfis || count($request->perfis) == 0) {
            return redirect()
                        ->back()
                        ->with('info', 'Precisa escolher pelo menos um perfil');
        }

        $plano->perfils()->attach($request->perfis);

        return redirect()->route('planos.perfis', $plano->id);
    }

    public function dettachPlanoPerfil($id, $idPerfil)
    {
        $plano = Plano::find($id);
        $perfil = Perfil::find($idPerfil);

        if (!$plano || !$perfil) {
            return redirect()->back()->with(['color' => 'danger', 'message' => 'Operação Inválida!']);
        }

        $plano->perfils()->detach($perfil);

        return redirect()->route('planos.perfis', $plano->id)->with(['color' => 'success', 'message' => 'O perfil foi removido com sucesso!']);
    }
}
