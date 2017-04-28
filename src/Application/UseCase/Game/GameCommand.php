<?php


namespace TicTacToe\Application\UseCase\Game;

use TicTacToe\Domain\Game\Model\Game;
use TicTacToe\Domain\User\Model\User;
use TicTacToe\Domain\Game\Repository\GameRepositoryInterface;

/**
 * Class GameCommand
 * @package TicTacToe\Application\UseCase\Game
 */
class GameCommand
{
    /** @var  GameRepositoryInterface */
    private $gameRepository;

    /**
     * GameCommand constructor.
     * @param GameRepositoryInterface $gameRepository
     */
    public function __construct(GameRepositoryInterface $gameRepository)
    {
        $this->gameRepository = $gameRepository;
    }

    /**
     * @param User $playerOne
     * @param User $playerTwo
     * @return Game
     */
    public function create(User $playerOne, User $playerTwo): Game
    {
        $game = new Game($playerOne, $playerTwo);

        $this->gameRepository->save($game);

        return $game;
    }

    /**
     * @param Game $game
     * @param int $column
     * @param int $row
     * @return Game
     */
    public function move(Game $game, int $column, int $row): Game
    {
        $game->move($column, $row);

        $this->gameRepository->save($game);

        return $game;
    }
}
