<?php

namespace TicTacToe\Domain\Game\VO;

use TicTacToe\Domain\Game\Exception\InvalidMovementException;

/**
 * Class Board
 * @package TicTacToe\Domain\Game\VO
 */
class Board
{

    const MIN_COLUMN = 0;
    const MAX_COLUMN = 2;
    const MIN_ROW = 0;
    const MAX_ROW = 2;

    /**
     * @var array
     */
    private $squares;

    /**
     * Board constructor.
     */
    public function __construct()
    {
        for ($row = self::MIN_ROW; $row <= self::MAX_ROW; $row++) {
            for ($col = self::MIN_COLUMN; $col <= self::MAX_COLUMN; $col++) {
                $this->squares[$row][$col] = null;
            }
        }
    }

    /**
     * @param int $column
     * @param int $row
     * @param string $mark
     * @return Board
     * @throws InvalidMovementException
     */
    public function setMark(int $column, int $row, string $mark)
    {
        $this->isValidPosition($column, $row);

        if ($this->squares[$row][$column]) {
            throw new InvalidMovementException();
        }

        $newBoard = clone $this;
        $newBoard->squares[$row][$column] = $mark;

        return $newBoard;
    }

    /**
     * @return array
     */
    public function squares(): array
    {
        return $this->squares;
    }

    /**
     * Return the Mark with the full row filled
     * @return mixed
     */
    public function getMarkOnCompletedRow()
    {
        foreach ($this->squares() as $rows) {
            if ($this->isFullArrayFilledWithSameMark($rows)) {
                return $rows[0];
            }
        }
    }

    /**
     * @return mixed
     */
    public function getMarkOnCompletedColumn()
    {
        for ($col = self::MIN_COLUMN; $col <= self::MAX_COLUMN; $col++) {
            $columnMarks = [];
            for ($row = self::MIN_ROW; $row <= self::MAX_ROW; $row++) {
                $columnMarks[] = $this->squares[$row][$col];
            }

            if ($this->isFullArrayFilledWithSameMark($columnMarks)) {
                return $columnMarks[0];
            }
        }
    }

    /**
     * @return mixed
     */
    public function getMarkOnCompletedDiagonal()
    {
        $rightDiagonal = [];
        $leftDiagonal = [];
        for ($col = self::MIN_COLUMN; $col <= self::MAX_COLUMN; $col++) {
            $leftDiagonal[] = $this->squares[$col][$col];
            $rightDiagonal[] = $this->squares[$col][self::MAX_ROW - $col];
        }

        if ($this->isFullArrayFilledWithSameMark($leftDiagonal)) {
            return $leftDiagonal[0];
        }

        if ($this->isFullArrayFilledWithSameMark($rightDiagonal)) {
            return $rightDiagonal[0];
        }
    }

    /**
     * Return the mark of the finded correct combination
     * @return mixed
     */
    public function getMarkOnFullCombination()
    {
        for ($col = self::MIN_COLUMN; $col <= self::MAX_COLUMN; $col++) {
            $columnMarks = [];
            $rowMarks = [];
            for ($row = self::MIN_ROW; $row <= self::MAX_ROW; $row++) {
                $columnMarks[] = $this->squares[$row][$col];
                $rowMarks[] = $this->squares[$col][$row];

            }
            if ($this->isFullArrayFilledWithSameMark($rowMarks)) {
                return $rowMarks[0];
            }
            if ($this->isFullArrayFilledWithSameMark($columnMarks)) {
                return $columnMarks[0];
            }

            $leftDiagonal[] = $this->squares[$col][$col];
            $rightDiagonal[] = $this->squares[$col][self::MAX_ROW - $col];

        }

        if ($this->isFullArrayFilledWithSameMark($leftDiagonal)) {
            return $leftDiagonal[0];
        }

        if ($this->isFullArrayFilledWithSameMark($rightDiagonal)) {
            return $rightDiagonal[0];
        }
    }

    /**
     * Return if the board is completed
     * @return bool
     */
    public function isFullBoardFilled()
    {
        foreach ($this->squares() as $rows) {
            if (in_array(null, $rows)) {
                return false;
            }
        }

        return true;
    }

    /**
     * @param int $column
     * @param int $row
     * @throws InvalidMovementException
     */
    protected function isValidPosition(int $column, int $row)
    {
        if ($column < self::MIN_COLUMN || $column > self::MAX_COLUMN || $row < self::MIN_ROW || $row > self::MAX_ROW) {
            throw new InvalidMovementException();
        }
    }

    /**
     * @param $array
     * @return bool
     */
    protected function isFullArrayFilledWithSameMark($array): bool
    {
        $isFullFilled = $this->isFullArrayFilled($array);
        $isSamePlayer = $this->isSameMark($array);

        return ($isFullFilled && $isSamePlayer && !empty($array[0]));
    }

    /**
     * @param $array
     * @return bool
     */
    protected function isSameMark($array):bool
    {
        return count(array_unique($array)) !== 1 ? false : true;
    }

    /**
     * @param $array
     * @return bool
     */
    protected function isFullArrayFilled($array):bool
    {
        return count(array_filter($array)) === count($array);
    }
}
