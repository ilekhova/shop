<?php
class LoginController extends BaseController {
 
public function doLogin()
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
			return Redirect::to('login')
				->withErrors($validator) // send back all errors to the login form
				->withInput(Input::except('password')); // send back the input (not the password) so that we can repopulate the form
		} else {
			// create our user data for the authentication
			$email  = Input::get('email');
            $password  = Input::get('password') ;
			// attempt to do the login
			
			if (Auth::attempt(array('email' => $email, 'password' => $password))) {
				$id= Auth::user()->id;
				$exists = DB::select(DB::raw('SELECT * FROM orders WHERE status = 0 AND user_id='.$id.''));
	    		if(!$exists)	
					{
					DB::table('orders')->insert(
				 	 array('status' => 0, 
	  				'user_id'=> $id, 
	  				'created' => DB::raw('NOW()')
	                )
					);	
				}
					return Redirect::to('landing');
				} else {	 	
					// validation not successful, send back to form	
					return Redirect::to('login');
				}
			}
}
	
	public function doLogout()
	{
		Auth::logout(); // log the user out of our application
		  Session::flush();
		return Redirect::to('login'); // redirect the user to the login screen
	}
	public function showLogin()
	{
		// show the form
		
		return View::make('login'); //->with('user', $usser);
	}
}
