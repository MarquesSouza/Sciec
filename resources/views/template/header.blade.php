<!-- Sidebar -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="">SB Admin</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">


        <ul class="nav navbar-nav navbar-right navbar-user">
            <li class="dropdown messages-dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i> Eventos
                    <span class="badge"><!-- poder colocar quantidade de eventos abertos--></span> <b class="caret"></b></a>

            </li>
            @if (Auth::check())
            <li class="dropdown alerts-dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell"></i> Certificados <span
                            class="badge"></span> <b class="caret"></b></a>

            </li>


            <li class="dropdown user-dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i>
                        {{ Auth::user()->name }}
                        <b
                            class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li class="pull-right">

                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                      document.getElementById('logout-form').submit();"><span class="fa fa-power-off"></span>Log Out
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                </ul>
            </li>
            @else

           @endif

        </ul>
    </div><!-- /.navbar-collapse -->
</nav>