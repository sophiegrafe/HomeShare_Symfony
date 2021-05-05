<?php

namespace App\Entity;

use App\Repository\ComentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ComentRepository::class)
 */
class Coment
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=128)
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdDate;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="coments")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=Blogpost::class, inversedBy="coments")
     * @ORM\JoinColumn(nullable=false)
     */
    private $blogpost;

    /**
     * @ORM\ManyToOne(targetEntity=Coment::class, inversedBy="replies")
     */
    private $reply;

    /**
     * @ORM\OneToMany(targetEntity=Coment::class, mappedBy="reply")
     */
    private $replies;

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
        $this->replies = new ArrayCollection();
        // appel au hydrate
        $this->hydrate($arrayInit);
    }

    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getCreatedDate(): ?\DateTimeInterface
    {
        return $this->createdDate;
    }

    public function setCreatedDate(\DateTimeInterface $createdDate): self
    {
        $this->createdDate = $createdDate;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getBlogpost(): ?Blogpost
    {
        return $this->blogpost;
    }

    public function setBlogpost(?Blogpost $blogpost): self
    {
        $this->blogpost = $blogpost;

        return $this;
    }

    public function getReply(): ?self
    {
        return $this->reply;
    }

    public function setReply(?self $reply): self
    {
        $this->reply = $reply;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getReplies(): Collection
    {
        return $this->replies;
    }

    public function addReply(self $reply): self
    {
        if (!$this->replies->contains($reply)) {
            $this->replies[] = $reply;
            $reply->setReply($this);
        }

        return $this;
    }

    public function removeReply(self $reply): self
    {
        if ($this->replies->removeElement($reply)) {
            // set the owning side to null (unless already changed)
            if ($reply->getReply() === $this) {
                $reply->setReply(null);
            }
        }

        return $this;
    }
}
