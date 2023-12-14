<?php

namespace MiW\Results\Tests\Entity;

use MiW\Results\Entity\Result;
use MiW\Results\Entity\User;

class ResultTest extends \PHPUnit\Framework\TestCase
{
    private User $user;
    private Result $result;
    private const USERNAME = 'uSeR ñ¿?Ñ';
    private const POINTS = 2018;
    private \DateTime $time;

    protected function setUp(): void
    {
        $this->user = new User();
        $this->user->setUsername(self::USERNAME);
        $this->time = new \DateTime('now');
        $this->result = new Result(self::POINTS, $this->user, $this->time);
    }

    public function testConstructor(): void
    {
        self::assertSame(0, $this->result->getId());
        self::assertSame(self::POINTS, $this->result->getResult());
        self::assertSame($this->user, $this->result->getUser());
        self::assertSame($this->time, $this->result->getTime());
    }

    public function testGetId(): void
    {
        self::assertSame(0, $this->result->getId());
    }

    public function testResult(): void
    {
        $newResult = 100;
        $this->result->setResult($newResult);
        self::assertSame($newResult, $this->result->getResult());
    }

    public function testUser(): void
    {
        $newUser = new User();
        $newUser->setUsername('NewUser');
        $this->result->setUser($newUser);
        self::assertSame($newUser, $this->result->getUser());
    }

    public function testTime(): void
    {
        $newTime = new \DateTime('tomorrow');
        $this->result->setTime($newTime);
        self::assertSame($newTime, $this->result->getTime());
    }

    public function testToString(): void
    {
        $expectedString = sprintf(
            '%3d - %3d - %22s - %s',
            $this->result->getId(),
            $this->result->getResult(),
            $this->result->getUser()->getUsername(),
            $this->result->getTime()->format('Y-m-d H:i:s')
        );

        self::assertSame($expectedString, (string)$this->result);
    }

    public function testJsonSerialize(): void
    {
        $expectedArray = [
            'id' => $this->result->getId(),
            'result' => $this->result->getResult(),
            'user' => $this->result->getUser(),
            'time' => $this->result->getTime()->format('Y-m-d H:i:s'),
        ];

        self::assertSame($expectedArray, $this->result->jsonSerialize());
    }
}
