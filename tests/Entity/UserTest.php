<?php

/**
 * tests/Entity/UserTest.php
 *
 * @category EntityTests
 * @package  MiW\Results\Tests
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://www.etsisi.upm.es/ ETS de Ingeniería de Sistemas Informáticos
 */

namespace MiW\Results\Tests\Entity;

use MiW\Results\Entity\User;

/**
 * Class UserTest
 *
 * @package MiW\Results\Tests\Entity
 * @group   users
 */
class UserTest extends \PHPUnit\Framework\TestCase
{
    private User $user;

    /**
     * Sets up the fixture.
     * This method is called before a test is executed.
     */
    protected function setUp(): void
    {
        $this->user = new User();
    }

    /**
     * @covers \MiW\Results\Entity\User::__construct()
     */
    public function testConstructor(): void
    {
        self::assertSame(0, $this->user->getId());
        self::assertSame('', $this->user->getUsername());

        $user = new User('JohnDoe', 'john@example.com', 'password', true, true);
        self::assertSame('JohnDoe', $user->getUsername());
        self::assertSame('john@example.com', $user->getEmail());
    }

    /**
     * @covers \MiW\Results\Entity\User::getId()
     */
    public function testGetId(): void
    {
        $this->user->setId(42);
        self::assertSame(42, $this->user->getId());
    }

    /**
     * @covers \MiW\Results\Entity\User::setUsername()
     * @covers \MiW\Results\Entity\User::getUsername()
     */
    public function testGetSetUsername(): void
    {
        $this->user->setUsername('JohnDoe');
        self::assertSame('JohnDoe', $this->user->getUsername());
    }

    /**
     * @covers \MiW\Results\Entity\User::getEmail()
     * @covers \MiW\Results\Entity\User::setEmail()
     */
    public function testGetSetEmail(): void
    {
        $this->user->setEmail('john@example.com');
        self::assertSame('john@example.com', $this->user->getEmail());
    }


    /**
     * @covers \MiW\Results\Entity\User::setEnabled()
     * @covers \MiW\Results\Entity\User::isEnabled()
     */
    public function testIsSetEnabled(): void
    {
        $this->user->setEnabled(true);
        self::assertTrue($this->user->isEnabled());
    }

    /**
     * @covers \MiW\Results\Entity\User::setIsAdmin()
     * @covers \MiW\Results\Entity\User::isAdmin
     */
    public function testIsSetAdmin(): void
    {
        $this->user->setIsAdmin(true);
        self::assertTrue($this->user->isAdmin());
    }

    /**
     * @covers \MiW\Results\Entity\User::setPassword()
     * @covers \MiW\Results\Entity\User::validatePassword()
     */
    public function testSetValidatePassword(): void
    {
        $this->user->setPassword('password');
        self::assertTrue($this->user->validatePassword('password'));
        self::assertFalse($this->user->validatePassword('wrongpassword'));
    }

    /**
     * @covers \MiW\Results\Entity\User::__toString()
     */
    public function testToString(): void
    {
        $this->user->setId(1);
        $this->user->setUsername('JohnDoe');
        $this->user->setEmail('john@example.com');
        $this->user->setEnabled(true);
        $this->user->setIsAdmin(true);
        self::assertSame('[User:   1 - JohnDoe - john@example.com - 1 - 1]', (string)$this->user);
    }

    /**
     * @covers \MiW\Results\Entity\User::jsonSerialize()
     */
    public function testJsonSerialize(): void
    {
        $this->user->setId(1);
        $this->user->setUsername('JohnDoe');
        $this->user->setEmail('john@example.com');
        $this->user->setEnabled(true);
        $this->user->setIsAdmin(true);
        $expectedArray = [
            'id'      => 1,
            'username' => 'JohnDoe',
            'email'    => 'john@example.com',
            'enabled'  => true,
            'admin'    => true,
        ];
        self::assertSame($expectedArray, $this->user->jsonSerialize());
    }

}
