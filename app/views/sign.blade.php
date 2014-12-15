<!doctype html>
<html>
<head>
	<title>Регистрация</title>
	<link rel="stylesheet" href="http://bootswatch.com/simplex/bootstrap.min.css">
</head>
<body>
<div class="container">

	{{ Form::open(array('url' => 'sign', 'class' => 'form-horizontal')) }}
		<div class="page-header">
			<h1>Регистрация</h1>
		</div>

		<!-- if there are login errors, show them here -->
		<p>
			{{ $errors->first('email') }}
			{{ $errors->first('password') }}
		</p>


		<div class="row form-group">
			{{ Form::label('username', 'Username', array('class' => 'control-label col-sm-2 col-sm-offset-2')) }}
			<div class="col-sm-6">
				{{ Form::text('username', null, array('class' => 'form-control')) }}
			</div>
		</div>


		<div class="row form-group">
			{{ Form::label('email', 'Email Address', ['class' => 'control-label col-sm-2 col-sm-offset-2']) }}
			<div class="col-sm-6">
				{{ Form::text('email', null, ['class' => 'form-control']) }}
			</div>
		</div>


		<div class="row form-group">
			{{ Form::label('password', 'Password', ['class' => 'control-label col-sm-2 col-sm-offset-2']) }}
			<div class="col-sm-6">
				{{ Form::password('password', ['class' => 'form-control']) }}
			</div>
		</div>

		
		<div class="row form-group">
			{{ Form::label('first_name', 'Your Name', ['class' => 'control-label col-sm-2 col-sm-offset-2']) }}
			<div class="col-sm-6">
				{{ Form::text('first_name', null, ['class' => 'form-control']) }}
			</div>
		</div>


		
		<div class="row form-group">
			{{ Form::label('address', 'Address', ['class' => 'control-label col-sm-2 col-sm-offset-2']) }}
			<div class="col-sm-6">
				{{ Form::text('address', null, ['class' => 'form-control']) }}
			</div>
		</div>

		<div class="row form-group">{{ Form::submit('Зарегестрироваться', ['class' => 'btn btn-success col-sm-offset-4']) }}</div>
	{{ Form::close() }}

</div>
</body>
</html>