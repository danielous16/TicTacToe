<?php


namespace TicTacToe\Infrastructure\UserBundle\Repository;


use Doctrine\ORM\EntityRepository;
use TicTacToe\Domain\User\Exception\UserNotFoundException;
use TicTacToe\Domain\User\Model\User;
use TicTacToe\Domain\User\Repository\UserRepositoryInterface;

class UserRepository extends EntityRepository implements UserRepositoryInterface
{
    /**
     * @param User $user
     */
    public function save(User $user)
    {
        $this->_em->persist($user);
        $this->_em->flush($user);
    }

    /**
     * @param string $username
     * @return User
     * @throws UserNotFoundException
     */
    public function getByUsername(string $username): User
    {
        $user = $this->findOneBy(['username' => $username]);

        if (!$user) {
            throw new UserNotFoundException();
        }

        return $user;
    }

    /**
     * @param User $user
     */
    public function remove(User $user)
    {
        $user->remove();

        $this->save($user);
    }
}
