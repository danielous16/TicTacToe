<?php

namespace TicTacToe\Domain\Game\Exception;


/**
 * Class InvalidMovementException
 * @package TicTacToe\Domain\Game\Exception
 */
class InvalidMovementException extends \Exception
{
    /**
     * InvalidMovementException constructor.
     */
    public function __construct()
    {
        parent::__construct('tic_tac_toe.exception.movement_not_valid', 404);
    }
}
