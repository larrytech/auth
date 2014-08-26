<?php

use Larrytech\Auth\Models\User;

class UserModelTest extends TestCase {

    public function testActivateSetsActivatedAsTrue()
    {
        $u = new User;
        $u->activate();
        $this->assertTrue($u->isActivated());
    }

    public function testSetActivationHash()
    {
        $u = new User;
        $this->assertEquals(null, $u->getActivationHash());
        $u->setActivationHash();
        $this->assertNotEquals(null, $u->getActivationHash());
    }

    /**
     * @expectedException \Larrytech\Auth\Models\UserActivationException
     */
    public function testSetActivationHashThrowsException()
    {
        $u = new User;
        $u->activate();
        $this->assertTrue($u->isActivated());
        $u->setActivationHash();
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

    public function testUserGetFullName()
    {
        $u = new User(array('first_name' => 'Joe', 'last_name' => 'Bloggs'));
        $this->assertEquals('Joe Bloggs', $u->name);
    }

    public function testUserGetFullNameAccessor()
    {
        $u = new User(array('first_name' => 'Joe', 'last_name' => 'Bloggs'));
        $this->assertEquals('Joe Bloggs', $u->getName());
    }

    public function testUserGetFullNameIsStudlyCase()
    {
        $u = new User(array('first_name' => 'joe', 'last_name' => 'bloggs'));
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