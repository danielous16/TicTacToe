<?php


namespace TicTacToe\UI\ConsoleBundle\Command\Game;


use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use TicTacToe\Domain\Game\Exception\GameNotFoundException;
use TicTacToe\Domain\Game\Exception\InvalidMovementException;
use TicTacToe\Domain\Game\Exception\InvalidPlayerException;
use TicTacToe\Domain\Game\Model\Game;
use TicTacToe\Domain\Game\VO\Board;
use TicTacToe\Domain\User\Exception\UserNotFoundException;
use TicTacToe\Domain\User\Model\User;

/**
 * Class GameStatusCommand
 * @package TicTacToe\UI\ConsoleBundle\Command\Game
 */
class GameStatusCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('tictactoe:game:status')
            ->setDescription('Return the game status.')
            ->addArgument('gameId', InputArgument::REQUIRED, 'Game identifier');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $gameQuery = $this->getContainer()->get('tictactoe.use_case.game_query');

        try {
            $game = $gameQuery->getById($input->getArgument('gameId'));
            $status = $game->status();

            if ($status === Game::DRAW) {
                $output->writeln('<comment>DRAW</comment>');
            } else if ($status === Game::FIRST_PLAYER_MARK) {
                $output->writeln("<comment>$status -> {$game->playerOne()->username()} won!</comment>");
            } else if ($status === Game::SECOND_PLAYER_MARK) {
                $output->writeln("<comment>$status -> {$game->playerTwo()->username()} won!</comment>");
            } else {
                $output->writeln("<comment>Incomplete</comment>");
            }

            $this->drawBoard($game->board(), $output);
        } catch (GameNotFoundException $e) {
            $output->writeln("<error>Game not found with ID: {$input->getArgument('gameId')}</error>");
        } catch (InvalidMovementException $e) {
            $output->writeln('<error>Invalid movement</error>');
        }
    }

    /**
     * @param Board $board
     * @param OutputInterface $output
     */
    private function drawBoard(Board $board, OutputInterface $output)
    {
        foreach ($board->squares() as $row => $rows) {
            $output->write("\n");
            foreach ($rows as $col => $cols) {
                $output->write('(' . ($rows[$col]?? ' ') . ')');
            }
        }
        $output->write("\n");
    }
}
