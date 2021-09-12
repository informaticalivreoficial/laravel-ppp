<?php

namespace App\Http\Controllers\ACL;

use App\Http\Controllers\Controller;
use App\Http\Requests\Permissao as Permission;
use App\Models\Permissoes;
use Illuminate\Http\Request;

class PermissaoController extends Controller
{
    public function index()
    {
        $permissoes = Permissoes::paginate();

        return view('admin.permissoes.index',[
            'permissoes' => $permissoes
        ]);
    }
    
    public function create()
    {
        return view('admin.permissoes.create');
    }
    
    public function store(Permission $request)
    {
        $criarPermissao = Permissoes::create($request->all());
        $criarPermissao->fill($request->all());

        return redirect()->route('permissoes.edit', [
            'permissao' => $criarPermissao->id
        ])->with(['color' => 'success', 'message' => 'Permissão cadastrada com sucesso!']);
    } 
    
    public function edit($permissao)
    {
        $permissao = Permissoes::where('id', $permissao)->first();

        return view('admin.permissoes.edit', [
            'permissao' => $permissao
        ]);
    }
    
    public function update(Permission $request, $permissao)
    {
        $permissaoUpdate = Permissoes::where('id', $permissao)->first();
        $permissaoUpdate->fill($request->all());
        $permissaoUpdate->save();

        return redirect()->route('permissoes.edit', [
            'permissao' => $permissaoUpdate->id,
        ])->with(['color' => 'success', 'message' => 'Permissão atualizada com sucesso!']);
    }

    public function delete(Request $request)
    {
        $permissao = Permissoes::where('id', $request->id)->first();
        if(!empty($permissao)){
            $json = "Você tem certeza que deseja excluir esta Permissão?";
            return response()->json([
                'error' => $json,
                'id' => $permissao->id
            ]);
        }else{
            return response()->json([
                'success' => true,
                'id' => $permissao->id
            ]);
        }
    }
    
    public function deleteon(Request $request)
    {
        $delete = Permissoes::where('id', $request->permissao_id)->first(); 

        $permissaoR = $delete->name;
        if(!empty($delete)){            
            $delete->delete();
        }
        return redirect()->route('permissoes.index')->with(['color' => 'success', 'message' => 'A permissão '.$permissaoR.' foi removido do plano com sucesso!']);
    }
}
