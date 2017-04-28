<?php


namespace TicTacToe\UI\ConsoleBundle\Command\User;


use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class DeleteUserCommand
 * @package TicTacToe\UI\ConsoleBundle\Command\User
 */
class DeleteUserCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('tictactoe:user:delete')
            ->setDescription('Delete a user by username')
            ->addArgument('username', InputArgument::REQUIRED, 'Username to delete')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $userQuery = $this->getContainer()->get('tictactoe.use_case.user_query');
        $userCommand = $this->getContainer()->get('tictactoe.use_case.user_command');

        $user = $userQuery->getUserByUsername($input->getArgument('username'));
        $userCommand->remove($user);

        $output->writeln('The user: ' . $user->username() . ' was deleted');
    }
}
