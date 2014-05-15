<?php

use Larrytech\Auth\Services\Validators\RoleValidator;
use Mockery as m;

class RoleValidatorTest extends TestCase {

	public function tearDown()
	{
		m::close();
	}


	public function testNameIsRequired()
	{
		$mock = $this->getStubModel();
		$mock->shouldReceive('getAttribute')->once()->with('id')->andReturn(1);
		$mock->shouldReceive('toArray')->once()->andReturn([]);

		$v = new RoleValidator($mock);
		$this->assertTrue($v->fails());
	}


	public function testNameIsUniqueFails()
	{
		$mock = $this->getStubModel();
		$mock->shouldReceive('getAttribute')->once()->with('id')->andReturn(1);
		$mock->shouldReceive('toArray')->once()->andReturn(['id' => 1, 'name' => 'Test']);

		$mock2 = $this->getPresenceVerifierInterface();
		$mock2->shouldReceive('getCount')->once()->andReturn(1);

		$v = new RoleValidator($mock);
		$v->getValidator()->setPresenceVerifier($mock2);

		$this->assertTrue($v->fails());
	}


	public function testNameIsUniquePasses()
	{
		$mock = $this->getStubModel();
		$mock->shouldReceive('getAttribute')->once()->with('id')->andReturn(1);
		$mock->shouldReceive('toArray')->once()->andReturn(['id' => 1, 'name' => 'Test']);

		$mock2 = $this->getPresenceVerifierInterface();
		$mock2->shouldReceive('getCount')->once()->andReturn(0);

		$v = new RoleValidator($mock);
		$v->getValidator()->setPresenceVerifier($mock2);

		$this->assertTrue($v->passes());
	}
	

	public function getPresenceVerifierInterface()
	{
		return m::mock('Illuminate\Validation\PresenceVerifierInterface');
	}
	

	public function getStubModel()
	{
		return m::mock('Larrytech\Auth\Models\Role');
	}
}
