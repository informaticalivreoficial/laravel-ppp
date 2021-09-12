@extends('adminlte::page')

@section('title', 'Gerenciar Perfis para '.$plano->name)

@section('content_header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1><i class="fas fa-search mr-2"></i> Gerenciar Perfis para {{$plano->name}}</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Painel de Controle</a></li>
            <li class="breadcrumb-item"><a href="{{route('planos.index')}}">Planos</a></li>
            <li class="breadcrumb-item active">Gerenciar Perfis</li>
        </ol>
    </div>
</div> 
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <div class="row">            
            <div class="col-12 my-2 text-right">
                <a href="{{ route('planos.perfis.available', $plano->id) }}" class="btn btn-sm btn-default"><i class="fas fa-plus mr-2"></i> Adicionar Perfil</a>
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
        @if(!empty($perfis) && $perfis->count() > 0)
            <table class="table table-bordered table-striped projects">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($perfis as $perfil)                    
                    <tr>                            
                        <td>{{$perfil->name}}</td>
                        <td>
                            <a data-toggle="tooltip" data-placement="top" title="Remover Perfil" href="{{ route('planos.perfis.dettach',[ 'id' => $plano->id, 'idPerfil' => $perfil->id] ) }}" class="btn btn-xs btn-danger text-white">Remover Perfil</a>                            
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
        {{ $perfis->links() }}       
    </div>
    <!-- /.card-body -->
</div>


@stop