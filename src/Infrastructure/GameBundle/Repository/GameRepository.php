<?php


namespace TicTacToe\Infrastructure\GameBundle\Repository;

use Doctrine\ORM\EntityRepository;
use TicTacToe\Domain\Game\Model\Game;
use TicTacToe\Domain\Game\Repository\GameRepositoryInterface;
use TicTacToe\Domain\Game\Exception\GameNotFoundException;

class GameRepository extends EntityRepository implements GameRepositoryInterface
{
    /**
     * @param Game $game
     */
    public function save(Game $game)
    {
        $this->_em->persist($game);
        $this->_em->flush($game);
    }

    /**
     * @param int $id
     * @return Game
     * @throws GameNotFoundException
     */
    public function getById(int $id): Game
    {
        $game = $this->find($id);

        if (!$game) {
            throw new GameNotFoundException();
        }

        return $game;
    }
}
