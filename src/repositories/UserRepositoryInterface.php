<?php namespace Larrytech\Auth\Repositories;

use Larrytech\Auth\Models\User;

interface UserRepositoryInterface {
    
    /**
     * Gets all roles.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all();

    /**
     * Returns a new user.
     *
     * @param array $attributes
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function create(array $attributes = array());

    /**
     * Finds a user by id.
     *
     * @param int $id
     */
    public function find($id);

    /**
     * Saves a user.
     *
     * @param \Larrytech\Auth\Models\User $user
     * @return void
     */
    public function save(User $user);

    /**
     * Updates a user with filled attributes.
     *
     * @param \Larryech\Auth\Models\User $user
     * @param array $attributes
     * @return void
     */
    public function update(User $user, array $attributes = array());
}