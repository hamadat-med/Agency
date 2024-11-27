<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $telephone = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $aPropos = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $instagram = null;

    /**
     * @var Collection<int, Peinture>
     */
    #[ORM\OneToMany(targetEntity: Peinture::class, mappedBy: 'user', orphanRemoval: true)]
    private Collection $peintures;

    /**
     * @var Collection<int, Blogpost>
     */
    #[ORM\OneToMany(targetEntity: Blogpost::class, mappedBy: 'user', orphanRemoval: true)]
    private Collection $blogposts;

    public function __construct()
    {
        $this->peintures = new ArrayCollection();
        $this->blogposts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): static
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getAPropos(): ?string
    {
        return $this->aPropos;
    }

    public function setAPropos(?string $aPropos): static
    {
        $this->aPropos = $aPropos;

        return $this;
    }

    public function getInstagram(): ?string
    {
        return $this->instagram;
    }

    public function setInstagram(?string $instagram): static
    {
        $this->instagram = $instagram;

        return $this;
    }

    /**
     * @return Collection<int, Peinture>
     */
    public function getPeintures(): Collection
    {
        return $this->peintures;
    }

    public function addPeinture(Peinture $peinture): static
    {
        if (!$this->peintures->contains($peinture)) {
            $this->peintures->add($peinture);
            $peinture->setUser($this);
        }

        return $this;
    }

    public function removePeinture(Peinture $peinture): static
    {
        if ($this->peintures->removeElement($peinture)) {
            // set the owning side to null (unless already changed)
            if ($peinture->getUser() === $this) {
                $peinture->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Blogpost>
     */
    public function getBlogposts(): Collection
    {
        return $this->blogposts;
    }

    public function addBlogpost(Blogpost $blogpost): static
    {
        if (!$this->blogposts->contains($blogpost)) {
            $this->blogposts->add($blogpost);
            $blogpost->setUser($this);
        }

        return $this;
    }

    public function removeBlogpost(Blogpost $blogpost): static
    {
        if ($this->blogposts->removeElement($blogpost)) {
            // set the owning side to null (unless already changed)
            if ($blogpost->getUser() === $this) {
                $blogpost->setUser(null);
            }
        }

        return $this;
    }
}
