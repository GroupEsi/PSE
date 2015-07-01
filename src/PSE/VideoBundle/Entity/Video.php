<?php

namespace PSE\VideoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Video
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="PSE\VideoBundle\Entity\VideoRepository")
 */
class Video
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
     * @ORM\Column(name="titre", type="string", length=255)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255)
     */
    private $url;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_id", type="integer")
     */
    private $serieId;

    /**
     * @var integer
     *
     * @ORM\Column(name="saison", type="integer")
     */
    private $saison;

    /**
     * @var integer
     *
     * @ORM\Column(name="episode", type="integer")
     */
    private $episode;

    /**
     * @var string
     *
     * @ORM\Column(name="urlImage", type="string", length=255)
     */
    private $urlImage;


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
     * Set titre
     *
     * @param string $titre
     * @return Video
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
    
        return $this;
    }

    /**
     * Get titre
     *
     * @return string 
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set url
     *
     * @param string $url
     * @return Video
     */
    public function setUrl($url)
    {
        $this->url = $url;
    
        return $this;
    }

    /**
     * Get url
     *
     * @return string 
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set serieId
     *
     * @param integer $serieId
     * @return Video
     */
    public function setSerieId($serieId)
    {
        $this->serieId = $serieId;
    
        return $this;
    }

    /**
     * Get serieId
     *
     * @return integer 
     */
    public function getSerieId()
    {
        return $this->serieId;
    }

    /**
     * Set saison
     *
     * @param integer $saison
     * @return Video
     */
    public function setSaison($saison)
    {
        $this->saison = $saison;
    
        return $this;
    }

    /**
     * Get saison
     *
     * @return integer 
     */
    public function getSaison()
    {
        return $this->saison;
    }

    /**
     * Set episode
     *
     * @param integer $episode
     * @return Video
     */
    public function setEpisode($episode)
    {
        $this->episode = $episode;
    
        return $this;
    }

    /**
     * Get episode
     *
     * @return integer 
     */
    public function getEpisode()
    {
        return $this->episode;
    }

    /**
     * Set urlImage
     *
     * @param string $urlImage
     * @return Video
     */
    public function setUrlImage($urlImage)
    {
        $this->urlImage = $urlImage;
    
        return $this;
    }

    /**
     * Get urlImage
     *
     * @return string 
     */
    public function getUrlImage()
    {
        return $this->urlImage;
    }
}
