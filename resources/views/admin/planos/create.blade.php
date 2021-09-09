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

@section('css')

@stop

@section('content_header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1>Cadastrar Plano</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Painel de Controle</a></li>
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
        <div class="card card-teal card-outline card-outline-tabs">            
            <div class="card-body">
                <form action="{{ route('planos.store') }}" method="post" enctype="multipart/form-data">
                @csrf                        
                <div class="tab-content" id="custom-tabs-four-tabContent">
                    <div class="tab-pane fade show active" id="custom-tabs-conteudo" role="tabpanel" aria-labelledby="custom-tabs-conteudo-tab">
                                               
                        <div class="row">
                            <div class="col-12 col-sm-7 col-md-8 col-lg-8">
                                <div class="form-group">
                                    <label class="labelforms text-muted"><b>Nome:</b></label>
                                    <input class="form-control" name="name" placeholder="Nome do Plano" value="{{old('name')}}">
                                </div>
                            </div>                            
                            <div class="col-12 col-sm-5 col-md-4 col-lg-4">
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
                                <x-adminlte-text-editor name="content" v placeholder="Descrição do plano..." :config="$config">{{old('content')}}</x-adminlte-text-editor>                                                      
                            </div>
                        </div> 
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



@section('js')
@stop