@extends('adminlte::page')

@section('title', 'Editar Detalhe do Plano'.$plano->name)

@section('content_header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1><i class="fas fa-search mr-2"></i>Editar detalhe do Plano {{$plano->name}}</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Painel de Controle</a></li>
            <li class="breadcrumb-item"><a href="{{route('planos.index')}}">Planos</a></li>
            <li class="breadcrumb-item"><a href="{{route('plan.details.index',$plano->slug)}}">Detalhes</a></li>
            <li class="breadcrumb-item active">Editar detalhe</li>
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

    @if(session()->exists('message'))
        @message(['color' => session()->get('color')])
        {{ session()->get('message') }}
        @endmessage
    @endif         
    </div>            
</div>

<div class="row">
    <div class="col-12">
        <div class="card card-teal card-outline">            
            <div class="card-body">
                <form action="{{ route('plan.details.update', ['slug' => $plano->slug, 'id' => $detalhe->id]) }}" method="post">
                @csrf    
                @method('PUT')      
                    <div class="row">
                        <div class="col-12 col-sm-4 col-md-4 col-lg-4">
                            <div class="form-group">
                                <label class="labelforms text-muted"><b>Nome:</b></label>
                                <input class="form-control" name="name" placeholder="Nome do Detalhe" value="{{ old('name') ?? $detalhe->name  }}">
                            </div>
                        </div>
                        <div class="col-12 col-sm-4 col-md-4 col-lg-4">
                            <div class="form-group">
                                <label class="labelforms text-muted">&nbsp;</label>
                                <button type="submit" class="d-block btn btn-success btn-lg"><i class="nav-icon fas fa-check mr-2"></i> Atualizar Agora</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div> 
        </div>
    </div>            
</div>
@stop