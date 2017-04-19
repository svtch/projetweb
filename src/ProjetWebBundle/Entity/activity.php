<?php

namespace ProjetWebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
* @ORM\Entity
* @ORM\Table(name="activity")
* @ORM\HasLifecycleCallbacks()
*/
class Activity
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


    /**
    * @ORM\OneToMany(targetEntity="ProjetWebBundle\Entity\Photos", mappedBy="Activity", cascade={"persist"})
    */
    private $photos;

    /**
     * @ORM\Column(type="string")
     */

    private $activityName;

    /**
     * @ORM\Column(type="datetime")
     */

    private $date;

    /**
     * @ORM\Column(type="string")
     */

    private $description;

    /**
     * @ORM\Column(type="integer")
     */

    private $state = 1;

    /**
     * @ORM\Column(type="integer")
     */

    private $price = 0;

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
     * Set activityName
     *
     * @param string $activityName
     *
     * @return Activity
     */
    public function setActivityName($activityName)
    {
        $this->activityName = $activityName;

        return $this;
    }

    /**
     * Get activityName
     *
     * @return string
     */
    public function getActivityName()
    {
        return $this->activityName;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Activity
     */
    public function setDate(\DateTime $date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Activity
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set state
     *
     * @param integer $state
     *
     * @return Activity
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return integer
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set price
     *
     * @param integer $price
     *
     * @return Activity
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return integer
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->photo = new \Doctrine\Common\Collections\ArrayCollection();
    }

    

    /**
     * Add photo
     *
     * @param \ProjetWebBundle\Entity\photos $photo
     *
     * @return Activity
     */
    public function addPhoto(Photos $photo) {
        $this->photos->add($photo);
        $photo->setActivity($this);
    }

    /**
     * Remove photo
     *
     * @param \ProjetWebBundle\Entity\photos $photo
     */
    public function removePhoto(Photos $photo)
    {
        $this->photos->removeElement($photo);
    }

    /**
     * Get photos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPhotos()
    {
        return $this->photos;
    }

}
