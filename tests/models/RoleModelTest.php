<?php

use Larrytech\Auth\Models\Role;

class RoleModelTest extends TestCase {

    public function testRoleGetNameAccessor()
    {
        $r = new Role(array('name' => 'admin'));
        $this->assertEquals('admin', $r->getName());
    }

    public function testRoleFillableAttributesAreFillable()
    {
        $r = new Role(array('name' => 'admin'));
        $this->assertEquals('admin', $r->getName());
    }

}