@extends('template.main')

@if ($sucesso==1)
    <div class="header">
        <h4 align="center" class="title">Inscrição Com sucesso!</h4>
    </div>
@else
    <div class="header">
        <h4 align="center" class="title">{{$colizoes[1]}}</h4>
    </div>
@endif