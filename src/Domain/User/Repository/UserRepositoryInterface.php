<?php

namespace TicTacToe\Domain\User\Repository;


use TicTacToe\Domain\User\Model\User;

/**
 * Interface UserRepositoryInterface
 * @package Domain\User\Repository
 */
interface UserRepositoryInterface
{
    /**
     * @param User $user
     */
    public function save(User $user);

    /**
     * @param string $username
     * @return User
     */
    public function getByUsername(string $username): User;

    /**
     * @param User $user
     */
    public function remove(User $user);
}
