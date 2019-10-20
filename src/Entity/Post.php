<?php


namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Exception;

/**
 * @ORM\Entity
 */
class Post
{
    const NUMBER_OF_ITEMS = 10;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $title;

    /**
     * @ORM\Column(type="string")
     */
    private $slug;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\Column(type="string")
     */
    private $authorEmail;

    /**
     * @ORM\Column(type="datetime")
     */
    private $publishedAt;

    /**
     * @ORM\OneToMany(
     *      targetEntity="Comment",
     *      mappedBy="post",
     *      orphanRemoval=true
     * )
     * @ORM\OrderBy({"publishedAt"="ASC"})
     */
    private $comments;

    /**
     * Post constructor.
     * @throws Exception
     */
    public function __construct()
    {
        $this->publishedAt = new DateTime();
        $this->comments = new ArrayCollection();
    }

    public function setAuthorEmail($email)
    {
        $this->authorEmail = $email;
    }

    public function setSlug($lastPostId)
    {
        $this->slug = 'post/' . $lastPostId;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @throws Exception
     */
    public function setPublishedAt()
    {
        $this->publishedAt = new \DateTime();
    }

    /**
     * @param $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return DateTime
     */
    public function getPublishedAt()
    {
        $timestamp = $this->publishedAt->getTimestamp();

        return date('d-F-Y H:i:s', $timestamp);
    }

    /**
     * @return string
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * @return string
     */
    public function getAuthorEmail()
    {
        return $this->authorEmail;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

}