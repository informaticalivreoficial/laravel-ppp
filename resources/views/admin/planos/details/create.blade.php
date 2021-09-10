@extends('adminlte::page')

@section('title', 'Cadastrar Detalhe do Plano'.$plano->name)

@section('content_header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1><i class="fas fa-search mr-2"></i>Cadastrar novo detalhe ao Plano {{$plano->name}}</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Painel de Controle</a></li>
            <li class="breadcrumb-item"><a href="{{route('planos.index')}}">Planos</a></li>
            <li class="breadcrumb-item"><a href="{{route('plan.details.index',$plano->slug)}}">Detalhes</a></li>
            <li class="breadcrumb-item active">Cadastrar novo detalhe</li>
        </ol>
    </div>
</div> 
@stop

@section('content')
<div class="row">
    <div class="col-12">
       @if($errors->all())
            @foreach($errors->all() as $error)
                @message(['color' => 'danger'])
                {{ $error }}
                @endmessage
            @endforeach
        @endif         
    </div>            
</div>

<div class="row">
    <div class="col-12">
        <div class="card card-teal card-outline">            
            <div class="card-body">
                <form action="{{ route('plan.details.store',$plano->slug) }}" method="post">
                @csrf          
                <div class="row">
                    <div class="col-12 col-sm-4 col-md-4 col-lg-4">
                        <div class="form-group">
                            <label class="labelforms text-muted"><b>Nome:</b></label>
                            <input class="form-control" name="name" placeholder="Nome do Detalhe" value="{{ old('name')  }}">
                        </div>
                    </div>
                    <div class="col-12 col-sm-4 col-md-4 col-lg-4">
                        <div class="form-group">
                            <label class="labelforms text-muted">&nbsp;</label>
                            <button type="submit" class="d-block btn btn-success btn-lg"><i class="nav-icon fas fa-check mr-2"></i> Cadastrar Agora</button>
                        </div>
                    </div>
                </div>
                </form>
            </div> 
        </div>
    </div>            
</div>
@stop