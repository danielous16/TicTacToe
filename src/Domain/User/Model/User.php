<?php


namespace TicTacToe\Domain\User\Model;

/**
 * Class User
 * @package TicTacToe\Domain\User\Model
 */
class User
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var string
     */
    protected $username;

    /**
     * @var \DateTime
     */
    protected $createdAt;

    /**
     * @var \DateTime
     */
    protected $deletedAt;

    /**
     * User constructor.
     * @param string $userName
     */
    public function __construct(string $userName)
    {
        $this->username = $userName;
        $this->createdAt = new \DateTime('now');
    }

    /**
     * @return int
     */
    public function id(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function username(): string
    {
        return $this->username;
    }

    /**
     * @return \DateTime
     */
    public function createdAt(): \DateTime
    {
        return $this->createdAt;
    }

    /**
     * @return null|\DateTime
     */
    public function deletedAt()
    {
        return $this->deletedAt;
    }

    /**
     * @return $this
     */
    public function remove()
    {
        $this->deletedAt = new \DateTime('now');

        return $this;
    }
}
