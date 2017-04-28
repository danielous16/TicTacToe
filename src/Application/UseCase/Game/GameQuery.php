<?php


namespace TicTacToe\Application\UseCase\Game;

use TicTacToe\Domain\Game\Model\Game;
use TicTacToe\Domain\User\Model\User;
use TicTacToe\Domain\Game\Repository\GameRepositoryInterface;

/**
 * Class GameQuery
 * @package TicTacToe\Application\UseCase\Game
 */
class GameQuery
{
    /** @var  GameRepositoryInterface */
    private $gameRepository;

    /**
     * GameQuery constructor.
     * @param GameRepositoryInterface $gameRepository
     */
    public function __construct(GameRepositoryInterface $gameRepository)
    {
        $this->gameRepository = $gameRepository;
    }

    /**
     * @param int $id
     * @return Game
     */
    public function getById(int $id): Game
    {
        return $this->gameRepository->getById($id);
    }
}
