<?php


namespace TicTacToe\UI\ConsoleBundle\Command\User;


use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use TicTacToe\Domain\User\Model\User;

/**
 * Class GetUserCommand
 * @package TicTacToe\UI\ConsoleBundle\Command\User
 */
class GetUserCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('tictactoe:user:get')
            ->setDescription('Retrieve a user by username')
            ->addArgument('username', InputArgument::REQUIRED, 'Username');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $userQuery = $this->getContainer()->get('tictactoe.use_case.user_query');

        $user = $userQuery->getUserByUsername($input->getArgument('username'));

        $output->writeln($this->formatUserToJson($user));
    }

    /**
     * @param User $user
     * @return array
     */
    private function formatUserToJson(User $user)
    {
        return json_encode([
            'id' => $user->id(),
            'username' => $user->username(),
            'createdAt' => $user->createdAt()->format('Y-m-d H:i:s'),
            'deletedAt' => $user->deletedAt() ? $user->deletedAt()->format('Y-m-d H:i:s') : ''
        ]);

    }
}
