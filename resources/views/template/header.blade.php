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
        <a class="navbar-brand" href="{{ route('painel') }}">SCIEC</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">



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
                        <li><a href="#"><i class="fa fa-user"></i> Profile</a></li>
                        <li><a href="#"><i class="fa fa-envelope"></i> Inbox <span class="badge">7</span></a></li>
                        <li><a href="#"><i class="fa fa-gear"></i> Settings</a></li>
                        <li class="divider"></li>
                        <li> <a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                      document.getElementById('logout-form').submit();"><i class="fa fa-power-off"></i>Log Out </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                        </li>
                    </ul>


                    </li>
                </ul>
            </li>
            @else
            <ul class="nav navbar-nav navbar-right navbar-user">
                <li class="dropdown messages-dropdown">
                    <a href="{{ route('login') }}">
                   <i class="fa fa-sign-in"></i> Login
                        <span class="badge"></span></a>

                </li>
                <li class="dropdown messages-dropdown">
                    <a href="{{ route('register') }}">
                        <i class="fa fa-user"></i> Cadastre-se
                        <span class="badge"></span></a>

                </li>
            </ul>
           @endif

    </div><!-- /.navbar-collapse -->
</nav>