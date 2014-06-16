<?php namespace Larrytech\Auth\Repositories;

use Larrytech\Auth\Models\User;

class DbUserRepository implements UserRepositoryInterface {
    
    /**
     * {@inheritDoc}
     */
    public function all()
    {
        return User::orderBy('last_name')->orderBy('first_name')->get();
    }

    /**
     * {@inheritDoc}
     */
    public function create(array $attributes = array())
    {
        return new User($attributes);
    }

    /**
     * {@inheritDoc}
     */
    public function find($id)
    {
        return User::find($id);
    }

    /**
     * {@inheritDoc}
     */
    public function save(User $user)
    {
        $user->save();
    }

    /**
     * {@inheritDoc}
     */
    public function update(User $user, array $attributes = array())
    {
        $user->fill($attributes);
    }
}