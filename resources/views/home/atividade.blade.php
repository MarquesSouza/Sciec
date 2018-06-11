@extends('template.main')
<br>
<div style="text-align: center">
<h2>{{$event->nome}}</h2>
<div style="width: 100%; height: 200px;">
    <div>
        <img class="card-img-top" src="http://www.ifto.edu.br/imagens/logomarcas/logomarca-da-home" alt="logo-evento">
    </div>
    <div>
        {{$event->descricao}}
    </div>
</div>
<div >
<form action="{{ url('user/event/'.$event->id.'/activity/insc') }}" method="post">

<fieldset class="module">
    <legend></legend>
    <table class="table table-hover">
        <thead>
        <tr style="font-weight:bold">
            <th width="5%">

            </th>
            <th class="sortable" width="65%">Programação</th>
            <th class="sortable" width="30%">Detalhes da Atividade</th>
        </tr>
        </thead>
        <tbody>
        @forelse($atividade as $at)
            <tr id="atividade_set-0" class="row1">
                <td align="center" style="vertical-align:middle">
                    <input type="checkbox" name="atividade" value="1051" id="{{$at->id}}" style="float:none">
                </td>
                <td style="vertical-align:middle">
                    {{$at->nome}}
                </td>
                <td>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Detalhes</button>

                    <div class="modal fade" id="myModal" role="dialog">
                        <div class="modal-dialog">

                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">{{$at->nome}}</h4>
                                </div>
                                <div class="modal-body">
                                    <p>Local: {{$at->local}}</p>
                                    <p>Horário: {{$at->horas}}</p>
                                    <p>Descrição:</p>
                                    <p>{{$at->descricao}}</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                            <br>

                </td>
            </tr>
        @empty
        @endforelse
        </tbody>

    </table>
</fieldset>
<hr>
<div style="text-align: center" class="submit-row">
    <input type="submit" class="btn btn-success" name="salvar" value="Inscrever">
</div>
</form>
</div>
</div>