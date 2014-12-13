<!doctype html>
<html>
<head>
	<title>Регистрация</title>
</head>
<body>

	{{ Form::open(array('url' => 'sign')) }}
		<h1>Регистрация</h1>

		<!-- if there are login errors, show them here -->
		<p>
			{{ $errors->first('email') }}
			{{ $errors->first('password') }}
		</p>


		<p>
			{{ Form::label('username', 'Username') }}
			{{ Form::text('username')}}
		</p>


		<p>
			{{ Form::label('email', 'Email Address') }}
			{{ Form::text('email') }}
		</p>


		<p>
			{{ Form::label('password', 'Password') }}
			{{ Form::password('password') }}
		</p>

		
		<p>
			{{ Form::label('first_name', 'Your Name') }}
			{{ Form::text('first_name')}}
		</p>


		
		<p>
			{{ Form::label('address', 'Address') }}
			{{ Form::text('address') }}
		</p>

		<p>{{ Form::submit('Submit!') }}</p>
	{{ Form::close() }}

</body>
</html>
