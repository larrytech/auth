<?php namespace Larrytech\Auth\Models;

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use InvalidArugmentException;

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
     * @param mixed $role The role.
     * @return \Larrytech\Auth\Models\Role
     * @throws \InvalidArugmentException
     * @throws \Larrytech\Auth\Models\DuplicateRoleException
     */
    public function assignRole($role)
    {
        if ($role == null)
        {
            throw new InvalidArgumentException;
        }

        if ($this->hasRole($role))
        {
            throw new DuplicateRoleException;
        }

        if ($role instanceof Role)
        {
            return $this->roles()->save($role);
        }

        if ($relation = Role::whereName($role)->first())
        {
            return $this->roles()->save($relation);
        }

        return $this->roles()->save(Role::create(array('name' => $role)));
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
     * {@inheritDoc}
     */
    public function getConstraints()
    {
        return array(
            'first_name' => 'required',
            'last_name'  => 'required',
            'email'      => 'required|email|unique:users,email,'.$this->id,
            'password'   => 'required'
        );
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
     * Gets the validator for the model.
     *
     * @return \Illuminate\Validation\Validator
     */
    public function getValidator()
    {
        return Validator::make($this->toArray(), $this->getConstraints());
    }

    /**
     * Determine if a user has a given role.
     *
     * @param mixed $role The role.
     * @return bool
     */
    public function hasRole($role)
    {
        if ($role instanceof Role)
        {
            return $this->roles->intersect($role)->isEmpty() == false;
        }

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
     * @param string $role The role.
     * @return int
     */
    public function revokeRole($role)
    {
        if ($role instanceof Role)
        {
            return $this->roles()->detech($role);
        }

        return $this->roles()->whereName($role)->detach();
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