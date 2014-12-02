<?php

class LoginController extends BaseController {

 

public function doLogin()
	{
	
		
		/// validate the info, create rules for the inputs
		$rules = array(
			'mail'    => 'required|mail', // make sure the email is an actual email
			'password' => 'required|alphaNum|min:3' // password can only be alphanumeric and has to be greater than 3 characters
		);

		// run the validation rules on the inputs from the form
		$validator = Validator::make(Input::all(), $rules);

		// if the validator fails, redirect back to the form
		if ($validator->fails()) {
			return Redirect::to('/')
				->withErrors($validator) // send back all errors to the login form
				->withInput(Input::except('password')); // send back the input (not the password) so that we can repopulate the form
		} else {

			// create our user data for the authentication
			$userdata = array(
				'mail' 	=> Input::get('mail'),
				'password' 	=> Input::get('password')
			);

			// attempt to do the login
		 
    	$check = User::qwerty();
			if ( $check  > 1) 
          
            {

				// validation successful!
				// redirect them to the secure section or whatever
				// return Redirect::to('secure');
				// for now we'll just echo success (even though echoing in a controller is bad)
				echo 'SUCCESS!';

			} else {	 	

				// validation not successful, send back to form	
				return Redirect::to('/'); //->with('user', $usser)

			}
		}
		
	}
	public function showLogin()
	{
		// show the form
		
		return View::make('login'); //->with('user', $usser);
	}

	

		public function doLogout()
	{
		//Auth::logout(); // log the user out of our application
		//return Redirect::to('login')->with('user', $user); // redirect the user to the login screen
	}
}