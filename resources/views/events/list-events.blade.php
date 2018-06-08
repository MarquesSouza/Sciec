@extends('template.main')

@section('content')

    @if (session('message'))
        <div class="alert alert-success">
            <ul>
                <li>{{ session('message') }}</li>
            </ul>
        </div>
    @endif

  {{--  <p><a href="" class="btn btn-success">Cadastrar empresa</a></p>--}}

    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-striped table-responsive">
                <thead>
                <tr>
                    <th>Nome</th>
                    <th>Descricao</th>
                    <th>Local</th>
                    <th>Data Inicio</th>
                    <th>Data Conclusao</th>
                    <th></th>


                </tr>
                </thead>
                <tbody id="events-list" name="events-list">
                @foreach($events as $event)
                    @if($event->status == 1)
                        <tr>


                            <td>{{$event->nome}}</td>
                            <td>{{$event->descricao}}</td>
                            <td>{{$event->local}}</td>
                            <td>{{$event->data_inicio}}</td>
                            <td>{{$event->data_conclusao}}</td>
                          {{--  <td>
                                <a href="{{route("detalhes.empresa", $company->id)}}" class="btn btn-primary"><i class="fa fa-eye" aria-hidden="true"></i> Detalhes</a>

                                <a href="{{route("excluir.cliente", $company->id)}}" class="btn btn-danger" onclick="return confirm('Confirmar exclusão de registro?');"><i class="fa fa-trash-o" aria-hidden="true"></i>Excluir</a>

                            </td>--}}


                        </tr>
                    @endif
                @endforeach
                </tbody>
            </table>

        </div>
    </div>

@endsection