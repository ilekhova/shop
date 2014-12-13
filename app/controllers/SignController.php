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
		if (($validator->fails())) {
			return Redirect::to('sign')
				->withErrors($validator) // send back all errors to the login form
				->withInput(Input::except('password')); // send back the input (not the password) so that we can repopulate the form
		} else {

			// create our user data for the authentication
			$userdata = array(

				'username' 	=> Input::get('username'),
				'email' 	=> Input::get('email'),
				'password' 	=> Input::get('password'),
				'first_name'=> Input::get('first_name'),
				'address' 	=> Input::get('address')

			);
			 
			$exists = DB::table('users')->where('email', '=', $userdata['email'])->get();

    		if($exists)	
			{
			
				return Redirect::to('sign');

			}
			else	 {	 	

				$userdata['password'] = Hash::make('secret');
				DB::table('users')->insert(
			  		array('username' => $userdata['username'], 'email' => $userdata['email'],
  						'password' => $userdata['password'], 'first_name' => $userdata['first_name'],
  						'address' => $userdata['address'], 'updated_at' => DB::raw('NOW()'),
  						'created_at' => DB::raw('NOW()'))
											);
			}
			
}
}
				

	public function showSignin()
	{
				return View::make('sign');
	}



}
