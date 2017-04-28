<?php

namespace TicTacToe\Domain\User\Exception;


/**
 * Class UserNotFoundException
 * @package TicTacToe\Domain\User\Exception
 */
class UserNotFoundException extends \Exception
{
    /**
     * UserNotFoundException constructor.
     */
    public function __construct()
    {
        parent::__construct('tic_tac_toe.exception.user_not_found', 404);
    }
}
