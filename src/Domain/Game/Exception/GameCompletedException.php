<?php

namespace TicTacToe\Domain\Game\Exception;


/**
 * Class GameCompletedException
 * @package TicTacToe\Domain\Game\Exception
 */
class GameCompletedException extends \Exception
{
    /**
     * GameCompletedException constructor.
     */
    public function __construct()
    {
        parent::__construct('tic_tac_toe.exception.game_completed', 404);
    }
}
