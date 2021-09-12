@extends('adminlte::page')

@section('title', 'Gerenciar Permissões para '.$perfil->name)

@section('content_header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1><i class="fas fa-search mr-2"></i> Gerenciar Permissões para {{$perfil->name}}</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Painel de Controle</a></li>
            <li class="breadcrumb-item active">Gerenciar Permissões</li>
        </ol>
    </div>
</div> 
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <div class="row">            
            <div class="col-12 my-2 text-right">
                <a href="{{ route('profiles.permissoes.available', $perfil->id) }}" class="btn btn-sm btn-default"><i class="fas fa-plus mr-2"></i> Adicionar Permissão</a>
            </div>
        </div>
      </div>    
    <!-- /.card-header -->
    <div class="card-body">
        <div class="row">
            <div class="col-12">                
                @if(session()->exists('message'))
                    @message(['color' => session()->get('color')])
                        {{ session()->get('message') }}
                    @endmessage
                @endif
            </div>            
        </div>
        @if(!empty($permissoes) && $permissoes->count() > 0)
            <table class="table table-bordered table-striped projects">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($permissoes as $permissao)                    
                    <tr>                            
                        <td>{{$permissao->name}}</td>
                        <td>
                            <a data-toggle="tooltip" data-placement="top" title="Remover Permissão" href="{{ route('profiles.permissoes.dettach',[ 'id' => $perfil->id, 'idPermissao' => $permissao->id] ) }}" class="btn btn-xs btn-danger text-white">Remover Permissão</a>                            
                        </td>
                    </tr>
                    @endforeach
                </tbody>                
            </table>
        @else
            <div class="row mb-4">
                <div class="col-12">                                                        
                    <div class="alert alert-info p-3">
                        Não foram encontrados registros!
                    </div>                                                        
                </div>
            </div>
        @endif
    </div>
    <div class="card-footer paginacao">  
        {{ $permissoes->links() }}       
    </div>
    <!-- /.card-body -->
</div>


@stop