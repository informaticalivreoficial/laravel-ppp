<?php

namespace App\Http\Controllers\ACL;

use App\Http\Controllers\Controller;
use App\Http\Requests\Profile as ProfileRequest;
use App\Models\Perfil;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    
    public function index()
    {
        $profiles = Perfil::orderBy('created_at', 'DESC')->paginate();

        return view('admin.profiles.index',[
            'profiles' => $profiles
        ]);
    }
    
    public function create()
    {
        return view('admin.profiles.create');
    }
    
    public function store(ProfileRequest $request)
    {
        $criarPerfil = Perfil::create($request->all());
        $criarPerfil->fill($request->all());

        return redirect()->route('profiles.edit', [
            'profile' => $criarPerfil->id
        ])->with(['color' => 'success', 'message' => 'Perfil cadastrado com sucesso!']);
    } 
    
    public function edit($profile)
    {
        $perfil = Perfil::where('id', $profile)->first();

        return view('admin.profiles.edit', [
            'profile' => $perfil
        ]);
    }
    
    public function update(ProfileRequest $request, $profile)
    {
        $perfilUpdate = Perfil::where('id', $profile)->first();
        $perfilUpdate->fill($request->all());
        $perfilUpdate->save();

        return redirect()->route('profiles.edit', [
            'profile' => $perfilUpdate->id,
        ])->with(['color' => 'success', 'message' => 'Perfil atualizado com sucesso!']);
    }

    public function delete(Request $request)
    {
        $perfil = Perfil::where('id', $request->id)->first();
        if(!empty($perfil)){
            $json = "Você tem certeza que deseja excluir este Perfil?";
            return response()->json([
                'error' => $json,
                'id' => $perfil->id
            ]);
        }else{
            return response()->json([
                'success' => true,
                'id' => $perfil->id
            ]);
        }
    }
    
    public function deleteon(Request $request)
    {
        $delete = Perfil::where('id', $request->profile_id)->first(); 

        $perfilR = $delete->name;
        if(!empty($delete)){            
            $delete->delete();
        }
        return redirect()->route('profiles.index')->with(['color' => 'success', 'message' => 'O perfil '.$perfilR.' foi removido do plano com sucesso!']);
    }
    
}
