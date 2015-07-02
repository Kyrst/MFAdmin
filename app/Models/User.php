<?php
namespace App\Models;

class User extends \PXLBros\PXLFramework\Models\User
{
	const EDIT_URL = 1;
	const DELETE_URL = 2;

	protected $fillable = ['email', 'first_name', 'last_name', 'password'];

	public function getName()
	{
		return $this->first_name . ' ' . $this->last_name;
	}

	public function getURL($type)
	{
		if ( $type === self::EDIT_URL )
		{
			return \URL::to('users/user/' . $this->id);
		}
		elseif ( $type === self::DELETE_URL )
		{
			return \URL::to('users/users/' . $this->id . '/delete');
		}
	}
}