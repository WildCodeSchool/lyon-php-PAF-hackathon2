<?php

namespace PAFBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * ChatForm
 *
 * @ORM\Table(name="chat")
 * @ORM\Entity(repositoryClass="PAFBundle\Repository\ChatRepository")
 */
class Chat
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="indicator", type="datetime")
     */
    private $indicator;

    /**
     * @var string
     *
     * @ORM\Column(name="message", type="text")
     * @Assert\NotBlank()
     */
    private $message;

    /**
    * @var int
    * @ORM\ManyToOne(targetEntity="User", inversedBy="chats")
    */
    private $user;

    /**
     * @var int
     * @ORM\ManyToOne(targetEntity="Channel", inversedBy="channels")
     */
    private $channel;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Chat
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set indicator
     *
     * @param \DateTime $indicator
     *
     * @return Chat
     */
    public function setIndicator($indicator)
    {
        $this->indicator = $indicator;

        return $this;
    }

    /**
     * Get indicator
     *
     * @return \DateTime
     */
    public function getIndicator()
    {
        return $this->indicator;
    }

    /**
     * Set message
     *
     * @param string $message
     *
     * @return Chat
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    public function __construct()
    {
        $this->indicator = new \DateTime();
    }

    /**
     * Set user
     *
     * @param \PAFBundle\Entity\User $user
     *
     * @return Chat
     */
    public function setUser(\PAFBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \PAFBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set channel
     *
     * @param \PAFBundle\Entity\Channel $channel
     *
     * @return Chat
     */
    public function setChannel(\PAFBundle\Entity\Channel $channel = null)
    {
        $this->channel = $channel;

        return $this;
    }

    /**
     * Get channel
     *
     * @return \PAFBundle\Entity\Channel
     */
    public function getChannel()
    {
        return $this->channel;
    }
}
