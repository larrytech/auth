<?php

use Larrytech\Auth\Models\User;

class UserModelTest extends TestCase {

    public function testActivateSetsActivatedAsTrue()
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

    /**
     * @expectedException     \Larrytech\Auth\Models\UserActivationException
     */
    public function testSetConfirmationHashThrowsException()
    {
        $u = new User;
        $u->activate();
        $this->assertTrue($u->isActive());
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
        $u = new User();
        $u->suspend();
        $this->assertTrue($u->isSuspended());
        $u->unsuspend();
        $this->assertFalse($u->isSuspended());
    }

    public function testUserGetFullNameAccessor()
    {
        $u = new User(array('first_name' => 'Joe', 'last_name' => 'Bloggs'));
        $this->assertEquals('Joe Bloggs', $u->getName());
    }

    public function testUserFillableAttributesAreFillable()
    {
        $u = new User(array('first_name' => 'Joe', 'last_name' => 'Bloggs', 'email' => 'joe.bloggs@example.com'));
        $this->assertEquals($u->getFirstName(), 'Joe');
        $this->assertEquals($u->getLastName(), 'Bloggs');
        $this->assertEquals($u->getReminderEmail(), 'joe.bloggs@example.com');
    }
    
}