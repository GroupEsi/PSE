<?php

namespace PSE\VideoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Comment
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="PSE\VideoBundle\Entity\CommentRepository")
 */
class Comment
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     */
    private $content;

    /**
     * @var integer
     *
     * @ORM\Column(name="video_id", type="integer")
     */
    private $videoId;

    /**
     * @var integer
     *
     * @ORM\Column(name="user_id", type="integer")
     */
    private $userId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datePublish", type="date")
     */
    private $datePublish;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set content
     *
     * @param string $content
     * @return Comment
     */
    public function setContent($content)
    {
        $this->content = $content;
    
        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set videoId
     *
     * @param integer $videoId
     * @return Comment
     */
    public function setVideoId($videoId)
    {
        $this->videoId = $videoId;
    
        return $this;
    }

    /**
     * Get videoId
     *
     * @return integer 
     */
    public function getVideoId()
    {
        return $this->videoId;
    }

    /**
     * Set userId
     *
     * @param integer $userId
     * @return Comment
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    
        return $this;
    }

    /**
     * Get userId
     *
     * @return integer 
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set datePublish
     *
     * @param \DateTime $datePublish
     * @return Comment
     */
    public function setDatePublish($datePublish)
    {
        $this->datePublish = $datePublish;
    
        return $this;
    }

    /**
     * Get datePublish
     *
     * @return \DateTime 
     */
    public function getDatePublish()
    {
        return $this->datePublish;
    }
}
