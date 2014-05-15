<?php namespace Larrytech\Auth\Models;

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Hash;

class User extends Model implements UserInterface, RemindableInterface {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes on the model which are mass-assignable.
     * 
     * @var string
     */
    protected $fillable = array('first_name', 'last_name', 'email');

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array('password');

    /**
     * Activates the user.
     * 
     * @return void
     */
    public function activate()
    {
        $this->active = 1;
        $this->confirmation_hash = "";
    }

    /**
     * Assign a user to a given role.
     *
     * @param string $name The name of the role.
     * @return \Larrytech\Auth\Models\Role
     */
    public function assignRole($name)
    {
        $role = Role::whereName($name)->first();

        if ($role == null) throw new ModelNotFoundException;

        return $this->roles()->save($role);
    }

    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->password;
    }

    /**
     * Gets the confirmation hash.
     *
     * @return string
     */
    public function getConfirmationHash()
    {
        return $this->confirmation_hash;
    }
    
    /**
     *  Gets the email address.
     * 
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }
    
    /**
     *  Gets the first name.
     * 
     * @return string
     */
    public function getFirstName()
    {
        return $this->first_name;
    }
    
    /**
     * Gets the last name.
     * 
     * @return string
     */
    public function getLastName()
    {
        return $this->last_name;
    }
    
    /**
     * Get the full name.
     *
     * @return string
     */
    public function getName()
    {
        return "$this->first_name $this->last_name";
    }

    /**
     * {@inheritDoc}
     */
    public function getRememberToken()
    {
        return $this->remember_token;
    }

    /**
     * {@inheritDoc}
     */
    public function getRememberTokenName()
    {
        return 'remember_token';
    }

    /**
     * Get the e-mail address where password reminders are sent.
     *
     * @return string
     */
    public function getReminderEmail()
    {
        return $this->email;
    }

    /**
     * Determine if a user has a given role.
     *
     * @param string $name The name of the role.
     * @return bool
     */
    public function hasRole($name)
    {
        return $this->roles()->whereName($name)->first() != null;
    }
    
    /**
     * Determine if the user is active.
     * 
     * @return bool
     */
    public function isActive()
    {
        return $this->active == 1;
    }

    /**
     * Determine if the user is suspended.
     * 
     * @return bool
     */
    public function isSuspended()
    {
        return $this->suspended == 1;
    }

    /**
     * Revoke a role from the user.
     *
     * @param string $name The name of the role.
     * @return int
     */
    public function revokeRole($name)
    {
        return $this->roles()->whereName($name)->detach();
    }
    
    /**
     * Sets a confirmation hash.
     */
    public function setConfirmationHash()
    {
        if ($this->isActive())
        {
            throw new UserActivationException;
        }

        $this->confirmation_hash = str_random(60);
    }

    /**
     * Sets the users password.
     *
     * @param string $value The plain text password to hash.
     * @return void
     */
    public function setPassword($value)
    {
        $this->password = Hash::make($value);
    }
    
    /**
     * Sets a random password.
     * 
     * @param int $length The length of the password.
     * @return string
     */
    public function setRandomPassword($length = 8)
    {
        $password = str_random($length);
        $this->setPassword($password);
        return $password;
    }

    /**
     * {@inheritDoc}
     */
    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }

    /**
     * Suspends the user.
     *
     * @return void
     */ 
    public function suspend()
    {
        $this->suspended = 1;
    }

    /**
     * Get the roles for the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany('Larrytech\Auth\Models\Role')->withTimestamps();
    }

    /**
     * Unsuspends the user.
     *
     * @return void
     */ 
    public function unsuspend()
    {
        $this->suspended = 0;
    }
}