<?php

namespace TicTacToe\Domain\Game\Exception;


/**
 * Class GameNotFoundException
 * @package TicTacToe\Domain\Game\Exception
 */
class GameNotFoundException extends \Exception
{
    /**
     * GameNotFoundException constructor.
     */
    public function __construct()
    {
        parent::__construct('tic_tac_toe.exception.game_not_found', 404);
    }
}
