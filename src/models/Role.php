<?php namespace Larrytech\Auth\Models;

class Role extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'roles';
    
    /**
     * The attributes on the model which are mass-assignable.
     * 
     * @var string
     */
    protected $fillable = array('name');

    /**
     * {@inheritDoc}
     */
    public function getConstraints()
    {
        return array(
            'name' => 'required|unique:roles,name,'.$this->id
        );
    }

    /**
     * Gets the name of a role.
     * 
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Gets the roles which have users.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->has('users');
    }

    /**
     * Gets the roles with no users.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeInactive($query)
    {
        return $query->has('users', '<', 1);
    }

    /**
     * Get the users for the role.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany('Larrytech\Auth\Models\User')->withTimestamps();
    }
}