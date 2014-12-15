<?php

class UserController extends BaseController {

	public function logout()
{

  Auth::logout();
   Session::reflash();
  return Redirect::to('/');
}

}