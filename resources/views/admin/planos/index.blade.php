@extends('adminlte::page')

@section('title', 'Gerenciar Planos')

@section('css')
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@stop

@section('content_header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1><i class="fas fa-search mr-2"></i> Planos</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Painel de Controle</a></li>
            <li class="breadcrumb-item active">Planos</li>
        </ol>
    </div>
</div> 
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-12 col-sm-6 my-2">
                <div class="card-tools">
                    <div style="width: 250px;">
                        <form class="input-group input-group-sm" action="{{route('planos.search')}}" method="post">
                            @csrf   
                            <input type="text" name="search" value="{{ $filters['search'] ?? '' }}" class="form-control float-right" placeholder="Pesquisar">
            
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                  </div>
            </div>
            <div class="col-12 col-sm-6 my-2 text-right">
                <a href="{{route('planos.create')}}" class="btn btn-sm btn-default"><i class="fas fa-plus mr-2"></i> Cadastrar Novo</a>
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
        @if(!empty($planos) && $planos->count() > 0)
            <table class="table table-bordered table-striped projects">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th class="text-center">Detalhes</th>
                        <th class="text-center">Valor</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($planos as $plano)                    
                    <tr style="{{ ($plano->status == '1' ? '' : 'background: #fffed8 !important;')  }}">                            
                        <td>{{$plano->name}}</td>
                        <td class="text-center">{{$plano->details()->count()}}</td>
                        <td class="text-center">R$ {{str_replace(',00', '', $plano->valor)}}</td>
                        <td>
                            <input type="checkbox" data-onstyle="success" data-offstyle="warning" data-size="mini" class="toggle-class" data-id="{{ $plano->id }}" data-toggle="toggle" data-style="slow" data-on="<i class='fas fa-check'></i>" data-off="<i style='color:#fff !important;' class='fas fa-exclamation-triangle'></i>" {{ $plano->status == true ? 'checked' : ''}}>
                            <a data-toggle="tooltip" data-placement="top" title="Editar Plano" href="{{route('planos.edit',$plano->id)}}" class="btn btn-xs btn-default"><i class="fas fa-pen"></i></a>
                            <a data-toggle="tooltip" data-placement="top" title="Detalhes do Plano" href="{{route('plan.details.index',$plano->slug)}}" class="btn btn-xs btn-primary">Detalhes</a>
                            <a data-toggle="tooltip" data-placement="top" title="Permissões" href="{{ route('planos.perfis', $plano->id ) }}" class="btn btn-xs btn-primary"><i class="fas fa-lock"></i></a>
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
        @if (isset($filters))
            {{ $planos->appends($filters)->links() }}
        @else
            {{ $planos->links() }}
        @endif        
    </div>
    <!-- /.card-body -->
</div>

<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="frm" action="" method="post">            
            @csrf
            @method('DELETE')
            <input id="id_plano" name="plano_id" type="hidden" value=""/>
                <div class="modal-header">
                    <h4 class="modal-title">Remover Plano!</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <span class="j_param_data"></span>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Sair</button>
                    <button type="submit" class="btn btn-primary">Excluir Agora</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
@stop

@section('js')
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script>
        $(function () {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            //FUNÇÃO PARA EXCLUIR
            $('.j_modal_btn').click(function() {
                var plano_id = $(this).data('id');                
                $.ajax({
                    type: 'GET',
                    dataType: 'JSON',
                    url: "{{ route('planos.delete') }}",
                    data: {
                       'id': plano_id
                    },
                    success:function(data) {
                        if(data.error){
                            $('.j_param_data').html(data.error);
                            $('#id_plano').val(data.id);
                            $('#frm').prop('action',"{{ route('planos.deleteon') }}");
                        }else{
                            $('#frm').prop('action',"{{ route('planos.deleteon') }}");
                        }
                    }
                });
            });

            $('#toggle-two').bootstrapToggle({
                on: 'Enabled',
                off: 'Disabled'
            });

            $('.toggle-class').on('change', function() {
                var status = $(this).prop('checked') == true ? 1 : 0;
                var plano_id = $(this).data('id');
                $.ajax({
                    type: 'GET',
                    dataType: 'JSON',
                    url: "{{ route('planos.planoSetStatus') }}",
                    data: {
                        'status': status,
                        'id': plano_id
                    },
                    success:function(data) {
                        
                    }
                });
            });
        });
    </script>
@stop
