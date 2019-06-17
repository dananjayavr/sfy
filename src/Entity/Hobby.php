<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\HobbyRepository")
 */
class Hobby
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Friend", mappedBy="loisir")
     */
    private $friend;

    public function __construct()
    {
        $this->friend = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|Friend[]
     */
    public function getFriend(): Collection
    {
        return $this->friend;
    }

    public function addFriend(Friend $friend): self
    {
        if (!$this->friend->contains($friend)) {
            $this->friend[] = $friend;
            $friend->addLoisir($this);
        }

        return $this;
    }

    public function removeFriend(Friend $friend): self
    {
        if ($this->friend->contains($friend)) {
            $this->friend->removeElement($friend);
            $friend->removeLoisir($this);
        }

        return $this;
    }
}
