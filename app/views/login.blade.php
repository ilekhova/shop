<!doctype html>
<html>
<head>
	<title>Look at me Login</title>
	<link rel="stylesheet" href="http://bootswatch.com/simplex/bootstrap.min.css">
</head>
<body>
<div class="container">

	{{ Form::open(array('url' => 'login', 'class' => 'form-horizontal')) }}
		<div class="page-header">
			<h1>Login</h1>
		</div>

		<!-- if there are login errors, show them here -->
		<div class="row form-group">
			{{ $errors->first('email') }}
			{{ $errors->first('password') }}
		</div>

		<div class="row form-group">
			{{ Form::label('email', 'Email Address', ['class' => 'control-label col-sm-2 col-sm-offset-2']) }}
			<div class="col-sm-6">
				{{ Form::text('email', Input::old('email'), array('placeholder' => 'awesome@awesome.com', 'class'=>'form-control')) }}
			</div>
		</div>

		<div class="row form-group">
			{{ Form::label('password', 'Password', ['class' => 'control-label col-sm-2 col-sm-offset-2']) }}
			<div class="col-sm-6">
				{{ Form::password('password', ['class'=>'form-control']) }}
			</div>
		</div>

		<div class="row form-group">{{ Form::submit('Авторизоваться', ['class' => 'btn btn-primary col-sm-offset-4']) }}</div>
	{{ Form::close() }}

</div>
</body>
</html>