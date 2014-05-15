<?php

use Larrytech\Auth\Models\Role;
use Mockery as m;

class RoleModelTest extends TestCase {

	public function tearDown()
	{
		m::close();
	}


	public function testRoleGetNameAccessor()
	{
		$r = new Role;
		$r->name = 'admin';
		$this->assertEquals('admin', $r->getName());
	}


	public function testRoleFillableAttributesAreFillable()
	{
		$r = new Role(['name' => 'admin']);
		$this->assertEquals('admin', $r->getName());
	}

}
