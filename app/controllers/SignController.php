<?php

class SignController extends BaseController {


	public function doSign()
	{
		

		 	// validate the info, create rules for the inputs
		$rules = array(
			'email'    => 'required|email', // make sure the email is an actual email
			'password' => 'required|alphaNum|min:3' // password can only be alphanumeric and has to be greater than 3 characters
		);

		// run the validation rules on the inputs from the form
		$validator = Validator::make(Input::all(), $rules);

		// if the validator fails, redirect back to the form
		if ($validator->fails()) {
			return Redirect::to('signin')
				->withErrors($validator) // send back all errors to the login form
				->withInput(Input::except('password')); // send back the input (not the password) so that we can repopulate the form
		} else {

			// create our user data for the authentication
			$userdata = array(

				'username' 	=> Input::get('username'),
				'email' 	=> Input::get('email'),
				'password' 	=> Input::get('password'),
				'firstname'	=> Input::get('firstname'),
				'address' 	=> Input::get('address')

			);

			$userdata['password'] = Hash::make('secret');

			DB::table('users')->insert(
			  array('username' => $userdata['username'], 'email' => $userdata['email'],
  					'password' => $userdata['password'], 'first_name' => $userdata['firstname'],
  					'address' => $userdata['address']
                )
				);


			// attempt to do the login
		/*	if (Auth::attempt($userdata)) {

				// validation successful!
				// redirect them to the secure section or whatever
				// return Redirect::to('secure');
				// for now we'll just echo success (even though echoing in a controller is bad)
				return var_dump('uraaaa');

			} else {	 	

				// validation not successful, send back to form	
				return Redirect::to('login');

			}

		}*/
}
}
				

	public function showSignin()
	{
		// show the form
		
		return View::make('sign');
	}



}
