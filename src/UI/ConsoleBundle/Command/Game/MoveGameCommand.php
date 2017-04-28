<?php


namespace TicTacToe\UI\ConsoleBundle\Command\Game;


use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use TicTacToe\Domain\Game\Exception\GameCompletedException;
use TicTacToe\Domain\Game\Exception\GameNotFoundException;
use TicTacToe\Domain\Game\Exception\InvalidMovementException;
use TicTacToe\Domain\Game\Exception\InvalidPlayerException;
use TicTacToe\Domain\Game\VO\Board;
use TicTacToe\Domain\User\Exception\UserNotFoundException;

/**
 * Class MoveGameCommand
 * @package TicTacToe\UI\ConsoleBundle\Command\Game
 */
class MoveGameCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('tictactoe:game:move')
            ->setDescription('Make a move')
            ->addArgument('gameId', InputArgument::REQUIRED, 'Game identifier')
            ->addArgument('column', InputArgument::REQUIRED, 'Column [1-2]')
            ->addArgument('row', InputArgument::REQUIRED, 'Row [1-2]');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $gameQuery = $this->getContainer()->get('tictactoe.use_case.game_query');
        $gameCommand = $this->getContainer()->get('tictactoe.use_case.game_command');

        try {
            $game = $gameQuery->getById($input->getArgument('gameId'));

            $column = $input->getArgument('column') - 1;
            $row = $input->getArgument('row') - 1;
            $gameCommand->move(
                $game,
                $column,
                $row
            );
            $output->writeln('<comment>Cooool!!</comment>');

            $this->drawBoard($game->board(), $output);
        } catch (GameNotFoundException $e) {
            $output->writeln("<error>Game not found with ID: {$input->getArgument('gameId')}</error>");
        } catch (InvalidMovementException $e) {
            $output->writeln('<error>Invalid movement</error>');
        } catch (GameCompletedException $e) {
            $output->writeln('<error>The game is completed.</error>');
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
