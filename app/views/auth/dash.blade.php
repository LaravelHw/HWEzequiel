<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AuthLaravelSimple</title>
  <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
  <link href="{{ asset('css/dash.css') }}" rel="stylesheet">
  <style>
  @import url(//fonts.googleapis.com/css?family=Lato:700);
  </style>
</head>
<body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">INCAN</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#">Dashboard</a></li>
            <li><a href="#">Settings</a></li>
            <li>
              <div class="navbar-collapse collapse">
                <div>
                  @if (Auth::check())
                    @if (Auth::user()->hasRole('crudRestriction'))
                      <ul class="nav navbar-nav pull-right">
                        <li class="dropdown">
                          <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <span class="icon icon-wh i-profile">{{ Auth::user()->username }} </span><span class="caret"></span>
                          </a>
                          <ul class="dropdown-menu">

                            <li><a onclick="showView('updateUser','ocultar')">Editar usuario</a></li>
                            <li><a href="{{ action('AuthController@logout') }}">Salir</a></li>
                          </ul>
                        </li>
                      </ul>
                    @endif
                  @endif
                </div>
              <div>
            </li>

          </ul>
          <form class="navbar-form navbar-right">
            <input type="text" class="form-control" placeholder="Search...">
          </form>
        </div>
      </div>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li class="active"><a href="#" onclick="showView('main','ocultar')">Dashboard <span class="sr-only">(current)</span></a></li>
            <li><a href="#" onclick="showView('asignarTarea','ocultar')">Asignar</a></li>
            <li><a href="#">Social Networking</a></li>
            <li><a href="#">favorites</a></li>
            <li><a href="#">Recommended</a></li>
          </ul>

        </div>

        <div id="main" class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 ocultar">

          <h1 class="page-header">Historial de Tareas Asignadas</h1>

          
          <table class="table table-hover">
            <thead>
              <tr>
                <th>Folio</th>
                <th>Area Solicitante </th>
                <th>Asunto</th>
                <th>Fecha Entrega</th>
                
              </tr>
            </thead>
            <tbody id="tasks">
              
            </tbody>
          </table>
          

          <h2 class="sub-header">Description</h2>
          <div class="table-responsive">
            <p>This project is a authentication system, bassically you can create users and make crud(create,read,update,delete) on him.
            if you hace questions my tw: @ezeezegg</p>
          </div>
        </div>

        <div id="updateUser" class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 ocultar" style="display:none" >
          <div class="col-md-4 col-md-offset-4">
            <img class="img-circle" src="{{asset(Auth::user()->avatar->url('thumb')) }}" >

            {{ Form::open(['route' => 'uploadImage', 'method' => 'POST', 'files' => true,'role' => 'form']) }}
              {{ Form::hidden('id', Auth::user()->id ) }}
              {{ Form::file('avatar') }}
              <input type="submit" value="Subir imagen" class="btn btn-success">
            {{ Form::close() }}

            {{ Form::open(['route' => 'updateUser', 'method' => 'POST', 'role' => 'form']) }}

              {{ Form::hidden('id', Auth::user()->id ) }}

              {{ Form::label('first_name', 'FirtsName', ['class' => 'sr-only']) }}
              {{ Form::text('first_name', Auth::user()->first_name , ['class' => 'form-control', 'placeholder' => 'Firstname', 'autofocus' => '']) }}


              {{ Form::label('last_name', 'Last Name', ['class' => 'sr-only']) }}
              {{ Form::text('last_name', Auth::user()->last_name , ['class' => 'form-control', 'placeholder' => 'Last Name', 'autofocus' => '']) }}

              {{Form::text('email', Auth::user()->email ,['class' => 'form-control', 'placeholder' => 'Email', 'autofocus' => ''])}}

              {{ Form::label('password', 'Password', ['class' => 'sr-only']) }}
              {{ Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password']) }}

            <p>
              <input type="submit" value="Actualizar" class="btn btn-success">
            </p>
            {{ Form::close() }}
        </div>
      </div>

      <div id="asignarTarea" class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 ocultar" style="display:none" >
          <div class="col-md-4 col-md-offset-4">
           
            {{ Form::open(['route' => 'asignarTarea', 'method' => 'POST', 'role' => 'form']) }}

              {{ Form::hidden('id', Auth::user()->id ) }}
              {{ Form::hidden('estatus', 'enproceso' ) }}

              {{ Form::label('Folio', 'Folio')}}
              {{ Form::text('folio','', ['class' => 'form-control', 'placeholder' => 'Folio', 'autofocus' => '']) }}

              {{ Form::label('Asunto', 'Asunto')}}
              {{ Form::text('asunto', '', ['class' => 'form-control', 'placeholder' => 'Asunto', 'autofocus' => '']) }}

              {{ Form::label('Asignado a', 'asignado a')}}
              <select id="usuarios" name="user_id">
                <option>Please choose car make first</option>
              </select>

              {{ Form::label('Fecha de respuesta', 'fecha respuesta')}}
              {{ Form::custom('date', 'fechaRespuesta') }}

              {{ Form::label('Area Solicitante', 'Area Solicitante')}}
              {{ Form::text('areaSolicitante', '' , ['class' => 'form-control', 'placeholder' => 'Area Solicitante', 'autofocus' => '']) }}

              

            <p>
              <input type="submit" value="Asignar" class="btn btn-success">
            </p>
            {{ Form::close() }}
        </div>
      </div>

      </div>
    </div>

</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="{{ asset('bootstrap-3.2.0/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('bootstrap-3.2.0/js/docs.min.js') }}"></script>
<script src="{{ asset('js/dash.js') }}"></script>

</html>
