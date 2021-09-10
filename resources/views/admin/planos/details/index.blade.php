@extends('adminlte::page')

@section('title', 'Detalhes do Plano'.$plano->name)

@section('css')
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@stop

@section('content_header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1><i class="fas fa-search mr-2"></i>Detalhes do Plano {{$plano->name}}</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Painel de Controle</a></li>
            <li class="breadcrumb-item"><a href="{{route('planos.index')}}">Planos</a></li>
            <li class="breadcrumb-item active">Detalhes do Plano</li>
        </ol>
    </div>
</div> 
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-12 my-2 text-right">
                <a href="{{route('plan.details.create',$plano->slug)}}" class="btn btn-sm btn-default"><i class="fas fa-plus mr-2"></i> Cadastrar Novo</a>
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
        @if(!empty($details) && $details->count() > 0)
            <table class="table table-bordered table-striped projects">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($details as $detail)                    
                    <tr>                            
                        <td>{{$detail->name}}</td>
                        <td class="acoes">
                            <a data-toggle="tooltip" data-placement="top" title="Editar Plano" href="{{route('plan.details.edit',['slug' => $plano->slug, 'id' => $detail->id])}}" class="btn btn-xs btn-default"><i class="fas fa-pen"></i></a>
                            <button data-placement="top" title="Remover Plano" type="button" class="btn btn-xs btn-danger text-white j_modal_btn" data-id="{{$detail->id}}" data-toggle="modal" data-target="#modal-default"><i class="fas fa-trash"></i></button>
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
        {{ $details->links() }}        
    </div>
    <!-- /.card-body -->
</div>

<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="frm" action="" method="post">            
            @csrf
            @method('DELETE')
            <input id="id_detail" name="detail_id" type="hidden" value=""/>
                <div class="modal-header">
                    <h4 class="modal-title">Remover Detalhe!</h4>
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
    <script>
        $(function () {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            //FUNÇÃO PARA EXCLUIR
            $('.j_modal_btn').click(function() {
                var detail_id = $(this).data('id');                
                $.ajax({
                    type: 'GET',
                    dataType: 'JSON',
                    url: "{{ route('plan.details.delete') }}",
                    data: {
                       'id': detail_id
                    },
                    success:function(data) {
                        if(data.error){
                            $('.j_param_data').html(data.error);
                            $('#id_detail').val(data.id);
                            $('#frm').prop('action',"{{ route('plan.details.deleteon') }}");
                        }else{
                            $('#frm').prop('action',"{{ route('plan.details.deleteon') }}");
                        }
                    }
                });
            });           

            
        });
    </script>
@stop
