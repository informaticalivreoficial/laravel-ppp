@extends('adminlte::page')

@section('title', 'Gerenciar Planos')

@section('css')
    
@stop

@section('content_header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1><i class="fas fa-search mr-2"></i> Planos</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{--route('admin.home')--}}">Painel de Controle</a></li>
            <li class="breadcrumb-item active">Planos</li>
        </ol>
    </div>
</div> 
@stop

@section('content')
<div class="card">
    <div class="card-header text-right">
        <a href="{{route('planos.create')}}" class="btn btn-default"><i class="fas fa-plus mr-2"></i> Cadastrar Novo</a>
    </div>        
    <!-- /.card-header -->
    <div class="card-body">
        <div class="row">
            <div class="col-12">    
                @if($errors->all())
                    @foreach($errors->all() as $error)
                        @message(['color' => 'danger'])
                            {{ $error }}
                        @endmessage
                    @endforeach
                @endif             
                @if(session()->exists('message'))
                    @message(['color' => session()->get('color')])
                        {{ session()->get('message') }}
                    @endmessage
                @endif
            </div>            
        </div>
        @if(!empty($planos) && $planos->count() > 0)
            <table class="table table-bordered table-striped projects">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Valor</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($planos as $plano)                    
                    <tr style="{{ ($plano->status == '1' ? '' : 'background: #fffed8 !important;')  }}">                            
                        <td>{{$plano->name}}</td>
                        <td>R$ {{str_replace(',00', '', $plano->valor)}}</td>
                        <td class="acoes">
                            <a data-toggle="tooltip" data-placement="top" title="Editar Plano" href="{{route('planos.edit',$plano->id)}}" class="btn btn-xs btn-default"><i class="fas fa-pen"></i></a>
                            <button data-placement="top" title="Remover Plano" type="button" class="btn btn-xs btn-danger text-white j_modal_btn" data-id="{{$plano->id}}" data-toggle="modal" data-target="#modal-default"><i class="fas fa-trash"></i></button>
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
        {{ $planos->links() }}
    </div>
    <!-- /.card-body -->
</div>
@stop

@section('js')
    <script>  </script>
@stop
