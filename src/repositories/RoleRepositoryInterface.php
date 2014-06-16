<?php namespace Larrytech\Auth\Repositories;

use Larrytech\Auth\Models\Role;

interface RoleRepositoryInterface {
    
    /**
     * Gets all roles.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all();

    /**
     * Returns a new role.
     *
     * @param array $attributes
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function create(array $attributes = array());

    /**
     * Finds a role by id.
     *
     * @param int $id
     */
    public function find($id);

    /**
     * Saves a role.
     *
     * @param \Larrytech\Auth\Models\Role $role
     * @return void
     */
    public function save(Role $role);

    /**
     * Updates a role with filled attributes.
     *
     * @param \Larryech\Auth\Models\Role $role
     * @param array $attributes
     * @return void
     */
    public function update(Role $role, array $attributes = array());
}