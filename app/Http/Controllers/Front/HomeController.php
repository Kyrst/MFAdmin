<?php
namespace App\Http\Controllers\Front;

class HomeController extends \App\Http\Controllers\FrontController
{
	public function home()
	{
		if ( $this->user !== null )
		{
			return redirect('dashboard');
		}

		return $this->display('MFAdmin', true);
	}

	public function signIn()
	{
		$input = \Input::all();

		$email = trim($input['email']);
		$password = trim($input['password']);

		if ( !\Auth::attempt(['email' => $email, 'password' => $password], true) )
		{
			return $this->ajax->outputWithError('Invalid email or password.');
		}

		return $this->ajax->output();
	}
}