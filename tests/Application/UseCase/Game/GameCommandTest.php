<?php


namespace Tests\Application\UseCase\Game;


use PHPUnit\Framework\TestCase;
use Tests\Domain\User\Model\UserTest;
use TicTacToe\Application\UseCase\Game\GameCommand;
use TicTacToe\Domain\Game\Model\Game;
use TicTacToe\Domain\Game\Repository\GameRepositoryInterface;
use TicTacToe\Infrastructure\GameBundle\Repository\GameRepository;

class GameCommandTest extends \PHPUnit_Framework_TestCase
{
    const FIRST_COLUMN = 0;
    const FIRST_ROW = 0;
    /**
     * @var GameCommand
     */
    private $gameCommand;

    public function setUp()
    {
        $gameRepository = \Mockery::mock(GameRepositoryInterface::class)
            ->shouldReceive('save')
            ->getMock()
        ;

        $this->gameCommand = new GameCommand($gameRepository);
    }

    /**
     * @group HappyPath
     */
    public function testCreateGameSuccess()
    {
        $playerOne = UserTest::makeUser('playerOne');
        $playerTwo = UserTest::makeUser('playerTwo');

        $newGame = $this->gameCommand->create($playerOne, $playerTwo);

        $this->assertInstanceOf(Game::class, $newGame);
    }

    /**
     * @group SadPath
     * @expectedException \TicTacToe\Domain\Game\Exception\InvalidPlayerException
     */
    public function testCreateGameFailureWithInvalidUser()
    {
        $playerOne = UserTest::makeUser('playerOne');
        $playerOne->remove();

        $this->gameCommand->create($playerOne, $playerOne);
    }

    /**
     * @group HappyPath
     */
    public function testMoveGameSuccess()
    {
        $playerOne = UserTest::makeUser('playerOne');
        $playerTwo = UserTest::makeUser('playerTwo');
        $game = new Game($playerOne, $playerTwo);

        $this->gameCommand->move($game, self::FIRST_COLUMN, self::FIRST_ROW);

        $this->assertEquals($playerOne, $game->lastPlayer());
        $this->assertNotEmpty($game->board()->squares()[self::FIRST_ROW][self::FIRST_COLUMN]);
    }
}
