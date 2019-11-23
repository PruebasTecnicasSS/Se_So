<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * Tbookmarks
 * @ORM\Table(name="TBookmarks")
 * @ORM\Entity
 */
class Tbookmarks
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=false)
     */
    private $date;

    /**
     * @var string|null
     *
     * @ORM\Column(name="url", type="string", length=255, nullable=false)
     */
    private $url;


    /**
     * @var string
     */
    private $twitterLink;

    /**
     * @var string
     */
    private $facebookLink;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param DateTime $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return null|string
     */
    public function getUrl(): ?string
    {
        return $this->url;
    }

    /**
     * @param null|string $url
     */
    public function setUrl(?string $url): void
    {
        $this->url = $url;
    }

    /**
     * @return string
     */
    public function getTwitterLink(): string
    {
        $this->twitterLink = $this->twitterling($this->getUrl());

        return $this->twitterLink;
    }

    /**
     * @return string
     */
    public function getFacebookLink(): string
    {
        $this->facebookLink = $this->facebookLink($this->getUrl());

        return $this->facebookLink;
    }


    /**
     * @param $url
     * @return string
     */
    private function twitterling($url)
    {

        $title     = 'Title here';
        $short_url = $url;
        $url       = $url;

        $twitter_params =
            '?text='.urlencode($title).'+-'.
            '&amp;url='.urlencode($short_url).
            '&amp;counturl='.urlencode($url).
            '';


        $link = "http://twitter.com/share".$twitter_params."";

        return $link;
    }

    /**
     * @param $url
     * @return string
     */
    private function facebookLink($url)
    {

        $link = "https://www.facebook.com/sharer.php?u=".$url."&t=TEst";

        return $link;
    }


}