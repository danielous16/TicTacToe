<?php


namespace TicTacToe\Application\UseCase\User;
use TicTacToe\Domain\User\Model\User;
use TicTacToe\Domain\User\Repository\UserRepositoryInterface;

/**
 * Class UserQuery
 * @package TicTacToe\Application\UseCase\User
 */
class UserQuery
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
    public function getUserByUsername(string $username): User
    {
        return $this->userRepository->getByUsername($username);
    }
}
