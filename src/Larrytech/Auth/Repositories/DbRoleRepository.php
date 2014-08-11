<?php namespace Larrytech\Auth\Repositories;

use Larrytech\Auth\Models\Role;

class DbRoleRepository implements RoleRepositoryInterface {
    
    /**
     * Gets all roles.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return Role::orderByName()->get();
    }

    /**
     * Returns a new role.
     *
     * @param array $attributes
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function create(array $attributes = array())
    {
        return new Role($attributes);
    }

    /**
     * Finds a role by id.
     *
     * @param int $id
     */
    public function find($id)
    {
        return Role::find($id);
    }

    /**
     * {@inheritDoc}
     */
    public function save(Role $role)
    {
        $role->save();
    }

    /**
     * {@inheritDoc}
     */
    public function update(Role $role, array $attributes = array())
    {
        $role->fill($attributes);
    }

}