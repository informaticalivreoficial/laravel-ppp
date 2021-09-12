<?php

namespace App\Http\Controllers\ACL;

use App\Http\Controllers\Controller;
use App\Models\Perfil;
use App\Models\Permissoes;
use Illuminate\Http\Request;

class PermissaoPerfilController extends Controller
{
    public function permissoes($idPermissao)
    {
        $perfil = Perfil::find($idPermissao);

        if(!$perfil){
            return redirect()->back()->with(['color' => 'danger', 'message' => 'Operação Inválida!']);
        }

        $permissoes = $perfil->permissoes()->paginate();

        return view('admin.profiles.permissions.index',[
            'perfil' => $perfil,
            'permissoes' => $permissoes
        ]);
    }

    public function permissoesAvalible(Request $request, $idPermissao)
    {
        $perfil = Perfil::find($idPermissao);

        if(!$perfil){
            return redirect()->back()->with(['color' => 'danger', 'message' => 'Operação Inválida!']);
        }

        $filters = $request->except('_token');

        $permissoes = $perfil->permissionsAvailable($request->filter);

        return view('admin.profiles.permissions.available',[
            'perfil' => $perfil,
            'filters' => $filters,
            'permissoes' => $permissoes
        ]);
    }    

    public function attachPermissionProfile(Request $request, $idPermissao)
    {
        $perfil = Perfil::find($idPermissao);

        if(!$perfil){
            return redirect()->back()->with(['color' => 'danger', 'message' => 'Operação Inválida!']);
        }

        if(!$request->permissions || count($request->permissions) == 0){
            return redirect()->back()->with(['color' => 'danger', 'message' => 'Escolha pelo menos uma permissão!']);
        }
        
        $permissoes = $perfil->permissoes()->attach($request->permissions);

        return redirect()->route('profiles.permissoes',$perfil->id)->with(['color' => 'success', 'message' => 'A permissão foi adicionada com sucesso!']);
    }

    public function dettachPermissionProfile($id, $idPermissao)
    {
        $perfil = Perfil::find($id);
        $permissao = Permissoes::find($idPermissao);

        if(!$perfil || !$permissao){
            return redirect()->back()->with(['color' => 'danger', 'message' => 'Operação Inválida!']);
        }

        $perfil->permissoes()->detach($permissao);

        return redirect()->route('profiles.permissoes', $perfil->id)->with(['color' => 'success', 'message' => 'A permissão foi removida com sucesso!']);
    }
}
