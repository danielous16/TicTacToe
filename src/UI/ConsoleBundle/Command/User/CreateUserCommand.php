<?php


namespace TicTacToe\UI\ConsoleBundle\Command\User;


use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class CreateUserCommand
 * @package TicTacToe\UI\ConsoleBundle\Command\User
 */
class CreateUserCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('tictactoe:user:create')
            ->setDescription('Create a new user with a username')
            ->addArgument('username', InputArgument::REQUIRED, 'New Username');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $userCommand = $this->getContainer()->get('tictactoe.use_case.user_command');

        $user = $userCommand->create($input->getArgument('username'));

        $output->writeln('User created with username: ' . $user->username());
    }
}
