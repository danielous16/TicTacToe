<?php

namespace TicTacToe\Domain\Game\Exception;


/**
 * Class InvalidPlayerException
 * @package TicTacToe\Domain\Game\Exception
 */
class InvalidPlayerException extends \Exception
{
    /**
     * InvalidPlayerException constructor.
     */
    public function __construct()
    {
        parent::__construct('tic_tac_toe.exception.user_not_valid', 404);
    }
}
