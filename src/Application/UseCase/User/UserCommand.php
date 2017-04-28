<?php


namespace TicTacToe\Application\UseCase\User;

use TicTacToe\Domain\User\Model\User;
use TicTacToe\Domain\User\Repository\UserRepositoryInterface;

/**
 * Class UserCommand
 * @package TicTacToe\Application\UseCase\User
 */
class UserCommand
{
    /** @var  UserRepositoryInterface */
    private $userRepository;

    /**
     * UserQuery constructor.
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param string $username
     * @return User
     */
    public function create(string $username): User
    {
        $user = new User($username);

        $this->userRepository->save($user);

        return $user;
    }

    /**
     * @param User $user
     */
    public function remove(User $user)
    {
        $this->userRepository->remove($user);
    }
}
