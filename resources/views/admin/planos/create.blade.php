@extends('adminlte::page')

@section('title', 'Cadastrar Plano')

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

@include('admin.includes.configtexteditor')

@section('content_header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1>Cadastrar Plano</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Painel de Controle</a></li>
            <li class="breadcrumb-item"><a href="{{route('planos.index')}}">Planos</a></li>
            <li class="breadcrumb-item active">Cadastrar Plano</li>
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
                <form action="{{ route('planos.store') }}" method="post">
                @csrf          
                    <div class="row">
                        <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label class="labelforms text-muted"><b>Nome:</b></label>
                                <input class="form-control" name="name" placeholder="Nome do Plano" value="{{old('name') }}">
                            </div>
                        </div> 
                        <div class="col-12 col-sm-3 col-md-3 col-lg-3"> 
                            <div class="form-group">
                                <label class="labelforms text-muted"><b>Valor</b></label>
                                <input type="text" class="form-control mask-money" name="valor" value="{{ old('valor') }}">
                            </div>
                        </div>                           
                        <div class="col-12 col-sm-3 col-md-3 col-lg-3">
                            <div class="form-group">
                                <label class="labelforms text-muted"><b>Status:</b></label>
                                <select name="status" class="form-control">
                                    <option value="1" {{ (old('status') == '1' ? 'selected' : '') }}>Publicado</option>
                                    <option value="0" {{ (old('status') == '0' ? 'selected' : '') }}>Rascunho</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">                            
                        <div class="col-12">   
                            <label class="labelforms text-muted"><b>Descrição do Plano:</b></label>
                            <x-adminlte-text-editor name="content" v placeholder="Descrição do plano..." :config="$config">{{ old('content') }}</x-adminlte-text-editor>                                                      
                        </div>
                    </div> 
                    <div class="row text-right">
                        <div class="col-12 mb-4">
                            <button type="submit" class="btn btn-success btn-lg"><i class="nav-icon fas fa-check mr-2"></i> Cadastrar Agora</button>
                        </div>
                    </div>
                </form>
            </div> 
        </div>
    </div>            
</div>
@stop