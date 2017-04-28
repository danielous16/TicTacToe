<?php

namespace Tests\Domain\User\Model;


use TicTacToe\Domain\User\Model\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{

    const FAKE_USERNAME = 'Fake username';

    public function testCreateUser()
    {
        $user = self::makeUser();

        $this->assertEquals($user->username(), self::FAKE_USERNAME);
    }


    public function testLogicalDeleteUser()
    {
        $user = self::makeUser();
        $user->remove();

        $this->assertNotNull($user->deletedAt());
    }

    /**
     * @param string $userName
     * @return User
     */
    public static function makeUser(string $userName = null):User
    {
        return new User($userName ?? self::FAKE_USERNAME);
    }
}
