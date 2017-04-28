<?php

namespace TicTacToe\Domain\Game\Repository;


use TicTacToe\Domain\Game\Model\Game;

/**
 * Interface GameRepositoryInterface
 * @package TicTacToe\Domain\Game\Repository
 */
interface GameRepositoryInterface
{
    /**
     * @param Game $game
     */
    public function save(Game $game);

    /**
     * @param int $id
     * @return Game
     */
    public function getById(int $id): Game;
}
