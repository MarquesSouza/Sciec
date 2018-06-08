@extends('template.main')

@section('content')
    @forelse($events as $event)
    <article class="events col-md-3 col-sm-6 col-xs-12">
        <img src="https://marketingdeconteudo.com/wp-content/uploads/2017/01/formatos-de-imagem-2.jpg" alt="">
        <div class="name-event"><h2>{{$event->nome}}</h2></div>
        <a href="" class="btn btn-success">Inscreva-se<i class="fa fa-cart-plus" aria-hidden="true"></i></a>
    </article>
    @empty

        @endforelse






   {{-- <a href="">
        <div class="col-lg-3">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row text-center">
                        <img src="https://marketingdeconteudo.com/wp-content/uploads/2017/01/formatos-de-imagem-2.jpg" alt="" width="250px" height="200px">
                    </div>
                </div>

                <div class="panel-footer announcement-bottom">
                    <div class="row text-center">
                        <h3>Clientes</h3>
                    </div>
                </div>

            </div>
        </div>
    </a>

    <a href="">
        <div class="col-lg-3">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <div class="row text-center">
                        <i class="fa fa-barcode fa-5x"></i>
                    </div>
                </div>

                <div class="panel-footer announcement-bottom">
                    <div class="row text-center">
                        <h3>Produtos</h3>
                    </div>
                </div>

            </div>
        </div>
    </a>

    <a href="">
        <div class="col-lg-3">
            <div class="panel panel-warning">
                <div class="panel-heading">
                    <div class="row text-center">
                        <i class="fa fa-wrench fa-5x"></i>
                    </div>
                </div>

                <div class="panel-footer announcement-bottom">
                    <div class="row text-center">
                        <h3>Serviços</h3>
                    </div>
                </div>

            </div>
        </div>
    </a>

    <a href="#">
        <div class="col-lg-3">
            <div class="panel panel-danger">
                <div class="panel-heading">
                    <div class="row text-center">
                        <i class="fa fa-file fa-5x"></i>
                    </div>
                </div>

                <div class="panel-footer announcement-bottom">
                    <div class="row text-center">
                        <h3>OS</h3>
                    </div>
                </div>

            </div>
        </div>
    </a>--}}

@endsection