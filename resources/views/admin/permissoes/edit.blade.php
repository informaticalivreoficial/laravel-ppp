@extends('adminlte::page')

@section('title', 'Editar Permissão')

@php
$config = [
    "height" => "300",
    "fontSizes" => ['8', '9', '10', '11', '12', '14', '18'],
    "lang" => 'pt-BR',
    "toolbar" => [
        // [groupName, [list of button]]
        ['style', ['style']],
        ['fontname', ['fontname']],
        ['fontsize', ['fontsize']],
        ['style', ['bold', 'italic', 'underline', 'clear']],
        //['font', ['strikethrough', 'superscript', 'subscript']],        
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['height', ['height']],
        ['table', ['table']],
        ['insert', ['link', 'picture', 'video','hr']],
        ['view', ['fullscreen', 'codeview']],
    ],
]
@endphp
@section('plugins.Summernote', true)

@section('content_header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1><i class="fas fa-search mr-2"></i>Editar Permissão</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Painel de Controle</a></li>
            <li class="breadcrumb-item"><a href="{{route('permissoes.index')}}">Permissões</a></li>
            <li class="breadcrumb-item active">Editar permissão</li>
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
                <form action="{{ route('permissoes.update', ['permissao' => $permissao->id]) }}" method="post">
                @csrf  
                @method('PUT')        
                <div class="row">
                    <div class="col-12 col-sm-4 col-md-4 col-lg-4">
                        <div class="form-group">
                            <label class="labelforms text-muted"><b>*Nome:</b></label>
                            <input class="form-control" name="name" placeholder="Nome da Permissão" value="{{ old('name') ?? $permissao->name  }}">
                        </div>
                    </div>
                    <div class="col-12 col-sm-4 col-md-4 col-lg-4">
                        <div class="form-group">
                            <label class="labelforms text-muted">&nbsp;</label>
                            <button type="submit" class="d-block btn btn-success btn-lg"><i class="nav-icon fas fa-check mr-2"></i> Atualizar Agora</button>
                        </div>
                    </div>
                </div>
                <div class="row">                            
                    <div class="col-12">   
                        <label class="labelforms text-muted"><b>Descrição da Permissão:</b></label>
                        <x-adminlte-text-editor name="content" v placeholder="Descrição do plano..." :config="$config">{{ old('content') ?? $permissao->content }}</x-adminlte-text-editor>                                                      
                    </div>
                </div>
                </form>
            </div> 
        </div>
    </div>            
</div>
@stop