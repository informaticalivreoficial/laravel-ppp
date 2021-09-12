@extends('adminlte::page')

@section('title', 'Perfis disponíveis para '.$plano->name)

@section('css')
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@stop

@section('content_header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1><i class="fas fa-search mr-2"></i> Perfis disponíveis para {{$plano->name}}</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Painel de Controle</a></li>
            <li class="breadcrumb-item"><a href="{{route('planos.perfis',$plano->id)}}">Perfis</a></li>
            <li class="breadcrumb-item active">Perfis disponíveis</li>
        </ol>
    </div>
</div> 
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <div class="row">  
            <div class="col-12 my-2">
                <div class="card-tools">
                    <div style="width: 250px;">
                        <form class="input-group input-group-sm" action="{{route('planos.perfis.available', $plano->id)}}" method="post">
                            @csrf   
                            <input type="text" name="filter" value="{{ $filters['filter'] ?? '' }}" class="form-control float-right" placeholder="Pesquisar">
            
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
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
        @if($perfis->count() > 0)    
        <form class="mt-3 d-inline" action="{{route('planos.perfis.attach', $plano->id)}}" method="post"> 
            @csrf     
            @foreach($perfis as $perfil)                       
                                                    
                <div class="form-group p-3 mb-1 col-12 col-sm-6 col-md-4 col-lg-3" style="float:left;">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="{{$perfil->id}}" name="perfis[]" value="{{$perfil->id}}">
                        <label for="{{$perfil->id}}" class="form-check-label">{{$perfil->name}}</label>
                    </div>
                </div>                             
            
            @endforeach
        </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <div class="float-right">
                    <button type="submit" class="btn btn-success btn-lg">Sincronizar Perfil</button>
                </div>
            </div>
            <!-- /.card-footer -->
        </form>
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
        @if (isset($filters))
            {{ $perfis->appends($filters)->links() }}
        @else
            {{ $perfis->links() }}
        @endif 
    </div>
    <!-- /.card-body -->
</div>


@stop