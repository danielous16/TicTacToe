<?php

namespace Domain\Game\VO;


use TicTacToe\Domain\Game\Model\Game;
use TicTacToe\Domain\Game\VO\Board;

class BoardTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @group HappyPath
     */
    public function testValidateColumnWithSameMarksSuccess()
    {
        $board = new Board();
        for ($pos = Board::MIN_COLUMN; $pos <= Board::MAX_COLUMN; $pos++) {
            $board = $board->setMark(Board::MIN_COLUMN, $pos, Game::FIRST_PLAYER_MARK);
        }
        $mark = $board->getMarkOnCompletedColumn();
        $this->assertEquals(Game::FIRST_PLAYER_MARK, $mark);
    }

    /**
     * @group HappyPath
     */
    public function testValidateRowWithSameMarksSuccess()
    {
        $board = new Board();
        for ($pos = Board::MIN_COLUMN; $pos <= Board::MAX_COLUMN; $pos++) {
            $board = $board->setMark($pos, Board::MIN_ROW, Game::FIRST_PLAYER_MARK);
        }
        $mark = $board->getMarkOnCompletedRow();
        $this->assertEquals(Game::FIRST_PLAYER_MARK, $mark);
    }

    /**
     * @group HappyPath
     */
    public function testValidateDiagonalWithSameMarksSuccess()
    {
        $board = new Board();
        for ($pos = Board::MIN_COLUMN; $pos <= Board::MAX_COLUMN; $pos++) {
            $board = $board->setMark($pos, $pos, Game::FIRST_PLAYER_MARK);
        }
        $mark = $board->getMarkOnCompletedDiagonal();
        $this->assertEquals(Game::FIRST_PLAYER_MARK, $mark);
    }

    /**
     * @group HappyPath
     */
    public function testIsFullBoardFilled()
    {
        $emptyBoard = new Board();
        $this->assertFalse($emptyBoard->isFullBoardFilled());

        $board = new Board();
        for ($row = Board::MIN_ROW; $row <= Board::MAX_ROW; $row++) {
            for ($col = Board::MIN_COLUMN; $col <= Board::MAX_COLUMN; $col++) {
                $board = $board->setMark($col, $row, Game::SECOND_PLAYER_MARK);
            }
        }

        $this->assertTrue($board->isFullBoardFilled());
    }
}
