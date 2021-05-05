<?php

namespace App\Entity;

use App\Repository\OptionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OptionRepository::class)
 * @ORM\Table(name="`option`")
 */
class Option
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private $optionName;

    /**
     * @ORM\ManyToMany(targetEntity=Property::class, inversedBy="options")
     */
    private $properties;

    // crée par nous mêmes, ainsi que le constructeur (vérifiez!)
    public function hydrate(array $init)
    {
        foreach ($init as $key => $value) {
            $method = "set" . ucfirst($key);
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    public function __construct($arrayInit = [])
    {
        
        $this->properties = new ArrayCollection();
        // appel au hydrate
        $this->hydrate($arrayInit);
    }    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOptionName(): ?string
    {
        return $this->optionName;
    }

    public function setOptionName(string $optionName): self
    {
        $this->optionName = $optionName;

        return $this;
    }

    /**
     * @return Collection|Property[]
     */
    public function getProperties(): Collection
    {
        return $this->properties;
    }

    public function addProperty(Property $property): self
    {
        if (!$this->properties->contains($property)) {
            $this->properties[] = $property;
        }

        return $this;
    }

    public function removeProperty(Property $property): self
    {
        $this->properties->removeElement($property);

        return $this;
    }
}
