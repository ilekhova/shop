<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User  {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	public  $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	/*protected $hidden = array('password');
	protected $fillable = array('login', 'mail');
	protected $guarded = array('user_id', 'password');


/**
 * Получить уникальный идентификатор пользователя.
 *
 * @return mixed
 */
/*public function getAuthIdentifier()
{
  return $this->getKey();
}

/**
 * Получить пароль пользователя.
 *
 * @return string
 */
/*public function getAuthPassword()
{
  return $this->password;
}

/**
 * Получить адрес e-mail для отправки напоминания о пароле.
 *
 * @return string
 */
/*public function getReminderEmail()
{
  return $this->mail;
}
*/


	public static function all()
	{
		return DB::select(DB::raw('SELECT * FROM users'));
	}

	public static function qwerty()
	{
		
	return DB::select(DB::raw('SELECT * FROM users where user_id = 1'));	
}

}
