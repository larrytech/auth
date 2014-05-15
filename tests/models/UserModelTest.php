<?php

use Larrytech\Auth\Models\User;
use Mockery as m;

class UserModelTest extends TestCase {

	public function tearDown()
	{
		m::close();
	}


	public function testActivateUserIsActivated()
	{
		$u = new User;
		$u->activate();
		$this->assertTrue($u->isActive());
	}


	public function testSetConfirmationHash()
	{
		$u = new User;
		$this->assertEquals(null, $u->getConfirmationHash());
		$u->setConfirmationHash();
		$this->assertNotEquals(null, $u->getConfirmationHash());
	}


	public function testSetConfirmationHashThrowsException()
	{
		$u = new User;
		$u->activate();
		$this->assertTrue($u->isActive());
		$this->setExpectedException('Larrytech\Auth\Models\UserActivationException');
		$u->setConfirmationHash();
	}


	public function testSuspendUserIsSuspended()
	{
		$u = new User;
		$u->suspend();
		$this->assertTrue($u->isSuspended());
	}


	public function testUnsuspendUserIsUnsuspended()
	{
		$u = new User;
		$u->suspended = 1;
		$this->assertTrue($u->isSuspended());
		$u->unsuspend();
		$this->assertFalse($u->isSuspended());
	}


	public function testUserGetFullNameAccessor()
	{
		$u = new User;
		$u->first_name = 'Joe';
		$u->last_name = 'Bloggs';
		$this->assertEquals($u->getName(), 'Joe Bloggs');
	}


	public function testUserFillableAttributesAreFillable()
	{
		$u = new User([
			'first_name' => 'Joe',
			'last_name' => 'Bloggs',
			'email' => 'joe.bloggs@example.com'
		]);

		$this->assertEquals($u->getFirstName(), 'Joe');
		$this->assertEquals($u->getLastName(), 'Bloggs');
		$this->assertEquals($u->getReminderEmail(), 'joe.bloggs@example.com');
	}
	
}