<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'user';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');
	protected $fillable = array('login', 'mail');
	protected $guarded = array('user_id', 'password');


/**
 * Получить уникальный идентификатор пользователя.
 *
 * @return mixed
 */
public function getAuthIdentifier()
{
  return $this->getKey();
}

/**
 * Получить пароль пользователя.
 *
 * @return string
 */
public function getAuthPassword()
{
  return $this->password;
}

/**
 * Получить адрес e-mail для отправки напоминания о пароле.
 *
 * @return string
 */
public function getReminderEmail()
{
  return $this->mail;
}

}
