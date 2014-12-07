
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
	protected $table = 'users';
	protected $fillable = ['username', 'email', 'password','first_name', 'address'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */

	protected $primaryKey = 'user_id';	

	protected $hidden = array('password');


	
	public function getAuthIdentifier() {

		return $this->getKey();

	}

	public function getAuthPassword() {

		return $this->password;

	}

	public function getReminderEmail() {
	
		return $this->email;
	
	}
	
	public function getRememberToken() {
		
		return $this->remember_token;
	}

	public function setRememberToken($value) {
		
		$this->remember_token = $value;
	}

	public function getRememberTokenName() {
		
		return 'remember_token';

	}

}
