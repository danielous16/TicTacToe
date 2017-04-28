<?php


namespace TicTacToe\UI\ConsoleBundle\Command\Game;


use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use TicTacToe\Domain\Game\Exception\InvalidPlayerException;
use TicTacToe\Domain\User\Exception\UserNotFoundException;

/**
 * Class CreateGameCommand
 * @package TicTacToe\UI\ConsoleBundle\Command\Game
 */
class CreateGameCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('tictactoe:game:create')
            ->setDescription('Create a new multiplayer game')
            ->addArgument('firstPlayer', InputArgument::REQUIRED, 'First player - username')
            ->addArgument('secondPlayer', InputArgument::REQUIRED, 'Second player - username');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $userQuery = $this->getContainer()->get('tictactoe.use_case.user_query');
        $gameCommand = $this->getContainer()->get('tictactoe.use_case.game_command');

        try {
            $firstPlayer = $userQuery->getUserByUsername($input->getArgument('firstPlayer'));
            $secondPlayer = $userQuery->getUserByUsername($input->getArgument('secondPlayer'));

            $game = $gameCommand->create($firstPlayer, $secondPlayer);

            $output->writeln('<info>Game created with players: </info>');
            $output->writeln('<comment>First player: </comment>' . $firstPlayer->username());
            $output->writeln('<comment>Second player: </comment>' . $secondPlayer->username());
            $output->writeln('<comment>Game ID: </comment>' . $game->id());
        } catch (UserNotFoundException $e) {
            $output->writeln('<error>User not foud</error>');
        } catch (InvalidPlayerException $e) {
            $output->writeln('<error>Invalid player</error>');
        }
    }
}
