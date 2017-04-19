<?php

namespace ProjetWebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="photos")
 */
class Photos
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="ProjetWebBundle\Entity\Activity", inversedBy="photos", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */

    private $activity;

    /**
     * @ORM\Column(type="string")
     *
     */

    private $pictureName;

    /**
     *
     * @Assert\File(maxSize="500k")
     *
     *
     */

    private $file;


    public function getWebPath()
    {
        return null === $this->pictureName ? null : $this->getUploadDir().'/'.$this->pictureName;
    }

    protected function getUploadRootDir()
    {
        // le chemin absolu du répertoire dans lequel sauvegarder les photos de profil
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        // get rid of the __DIR__ so it doesn't screw when displaying uploaded doc/image in the view.
        return 'uploads/pictures';
    }

    public function uploadProfilePicture()
    {
        // Nous utilisons le nom de fichier original, donc il est dans la pratique
        // nécessaire de le nettoyer pour éviter les problèmes de sécurité

        // move copie le fichier présent chez le client dans le répertoire indiqué.
        $this->file->move($this->getUploadRootDir(), $this->file->getClientOriginalName());

        // On sauvegarde le nom de fichier
        $this->pictureName = $this->file->getClientOriginalName();

        // La propriété file ne servira plus
        $this->file = null;
    }


    /**
     * @ORM\Column(type="string")
     */

    private $descriptionPhoto;



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
     * Set activity
     *
     * @param \ProjetWebBundle\Entity\Activity $activity
     *
     * @return Photos
     */
    public function setActivity(\ProjetWebBundle\Entity\Activity $activity)
    {
        $this->activity = $activity;

        return $this;
    }

    /**
     * Get activity
     *
     * @return \ProjetWebBundle\Entity\Activity
     */
    public function getActivity()
    {
        return $this->activity;
    }



    /**
     * Set descriptionPhoto
     *
     * @param string $descriptionPhoto
     *
     * @return Photos
     */
    public function setDescriptionPhoto($descriptionPhoto)
    {
        $this->descriptionPhoto = $descriptionPhoto;

        return $this;
    }

    /**
     * Get descriptionPhoto
     *
     * @return string
     */
    public function getDescriptionPhoto()
    {
        return $this->descriptionPhoto;
    }

    

    /**
     * Set pictureName
     *
     * @param string $pictureName
     *
     * @return Photos
     */
    public function setPictureName($pictureName)
    {
        $this->pictureName = $pictureName;

        return $this;
    }

    /**
     * Get pictureName
     *
     * @return string
     */
    public function getPictureName()
    {
        return $this->pictureName;
    }

    /**
     * Set pictureName
     *
     * @param string $file
     *
     * @return Photos
     */
    public function setFile($file)
    {
        $this->pictureName = $file;

        return $this;
    }

    /**
     * Get file
     *
     * @return string
     */
    public function getFile()
    {
        return $this->file;
    }
}
