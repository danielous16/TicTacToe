<?php


namespace TicTacToe\Domain\Game\Model;

use TicTacToe\Domain\Game\Exception\GameCompletedException;
use TicTacToe\Domain\Game\Exception\InvalidPlayerException;
use TicTacToe\Domain\Game\VO\Board;
use TicTacToe\Domain\User\Model\User;

/**
 * Class Game
 * @package TicTacToe\Domain\Game\Model
 */
class Game
{
    const FIRST_PLAYER_MARK = 'O';
    const SECOND_PLAYER_MARK = 'X';
    const DRAW = 'draw';

    /**
     * @var integer
     */
    private $id;
    /**
     * @var User
     */
    private $playerOne;

    /**
     * @var User
     */
    private $playerTwo;

    /**
     * @var User
     */
    private $lastPlayer;

    /**
     * @var Board
     */
    private $board;

    /**
     * TicTacToe constructor.
     * @param User $playerOne
     * @param User $playerTwo
     */
    public function __construct(User $playerOne, User $playerTwo)
    {
        $this->isActiveUser($playerTwo);
        $this->isActiveUser($playerOne);

        $this->playerOne = $playerOne;
        $this->playerTwo = $playerTwo;
        $this->lastPlayer = null;
        $this->board = new Board();
    }

    /**
     * @param int $column
     * @param int $row
     */
    public function move(int $column, int $row)
    {
        $this->isGameCompleted();

        $this->board = $this->board->setMark($column, $row, $this->getNextPlayerMark());
        $this->updateLastPlayer();
    }

    /**
     * @return bool|string
     */
    public function status()
    {
        $completed = $this->board()->isFullBoardFilled();

        if ($markPlayer = $this->board()->getMarkOnFullCombination()) {
            return $markPlayer;
        }

        if ($completed) {
            return self::DRAW;
        }

        return false;
    }

    /**
     * @return int
     */
    public function id(): int
    {
        return $this->id;
    }

    /**
     * @return Board
     */
    public function board()
    {
        return $this->board;
    }

    /**
     * @return User
     */
    public function playerOne(): User
    {
        return $this->playerOne;
    }

    /**
     * @return User
     */
    public function playerTwo(): User
    {
        return $this->playerTwo;
    }

    /**
     * @return User
     */
    public function lastPlayer(): User
    {
        return $this->lastPlayer;
    }

    /**
     * @return string
     */
    private function getNextPlayerMark()
    {
        return $this->lastPlayer === $this->playerOne ? self::SECOND_PLAYER_MARK : self::FIRST_PLAYER_MARK;
    }

    /**
     * Update the lastPlayer with the next player
     */
    private function updateLastPlayer()
    {
        $this->lastPlayer = $this->lastPlayer === $this->playerOne ? $this->playerTwo : $this->playerOne;
    }

    /**
     * @param User $player
     * @throws InvalidPlayerException
     */
    private function isActiveUser(User $player)
    {
        if ($player->deletedAt()) {
            throw new InvalidPlayerException();
        }
    }

    /**
     * @throws GameCompletedException
     */
    private function isGameCompleted()
    {
        if ($this->status()) {
            throw new GameCompletedException();
        }
    }
}
