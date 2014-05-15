<?php

use Larrytech\Auth\Services\Validators\UserValidator;
use Mockery as m;

class UserValidatorTest extends TestCase {

	public function tearDown()
	{
		m::close();
	}


	public function testEmailIsUniqueFails()
	{
		$mock = $this->getStubModel();
		$mock->shouldReceive('getAttribute')->once()->with('id')->andReturn(1);
		$mock->shouldReceive('toArray')->once()->andReturn(['id' => 1, 'email' => 'test@example.com']);

		$mock2 = $this->getPresenceVerifierInterface();
		$mock2->shouldReceive('getCount')->once()->andReturn(1);

		$v = new UserValidator($mock);
		$v->getValidator()->setPresenceVerifier($mock2);

		$this->assertTrue($v->fails());
	}
	

	public function testEmailIsUniquePasses()
	{
		$mock = $this->getStubModel();
		$mock->shouldReceive('getAttribute')->once()->with('id')->andReturn(1);
		$mock->shouldReceive('toArray')->once()->andReturn(['id' => 1, 'email' => 'test@example.com']);

		$mock2 = $this->getPresenceVerifierInterface();
		$mock2->shouldReceive('getCount')->once()->andReturn(0);

		$v = new UserValidator($mock);
		$v->getValidator()->setPresenceVerifier($mock2);

		$this->assertTrue($v->fails());
	}
	

	public function testNameIsRequiredPasses()
	{
		$mock = $this->getStubModel();
		$mock->shouldReceive('getAttribute')->once()->with('id')->andReturn(null);
		$mock->shouldReceive('toArray')->once()->andReturn([]);

		$mock2 = $this->getPresenceVerifierInterface();

		$v = new UserValidator($mock);

		$this->assertTrue($v->fails());
	}
	

	public function getPresenceVerifierInterface()
	{
		return m::mock('Illuminate\Validation\PresenceVerifierInterface');
	}
	

	public function getStubModel()
	{
		return m::mock('Larrytech\Auth\Models\User');
	}
}
