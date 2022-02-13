<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CardRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Core\Annotation\ApiFilter;


#[ORM\Entity(repositoryClass: CardRepository::class)]
#[ApiResource(
    collectionOperations: [
        'get' => [
            'normalization_context' => ['groups' => ['read-list:card']],
        ],
        'post' => [
            'denormalization_context' => ['groups' => ['write:card']],
        ]
    ],
    itemOperations: [
        'get',
        'put',
        'delete'
    ]
)]
//#[ApiFilter(SearchFilter::class, properties: ['content' => 'partial'])]
class Card
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(['read-list:card','write:card'])]
    #[Assert\NotBlank()]
    private $word;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(['read-list:card','write:card'])]
    #[Assert\NotBlank()]
    private $language;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(['read-list:card','write:card'])]
    #[Assert\NotBlank()]
    private $translation;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(['read-list:card'])]
    #[Assert\NotBlank()]
    private $status;

    #[ORM\Column(type: 'integer')]
    #[Groups(['read-list:card'])]
    #[Assert\NotBlank()]
    private $score;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'tweets')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['read-list:card'])]
    private $author;

    public function __construct()
    {
        $this->status = 'new';
        $this->score = 0;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getWord(): ?string
    {
        return $this->word;
    }

    public function setWord(string $word): self
    {
        $this->word = $word;

        return $this;
    }

    public function getLanguage(): ?string
    {
        return $this->language;
    }

    public function setLanguage(string $language): self
    {
        $this->language = $language;

        return $this;
    }

    public function getTranslation(): ?string
    {
        return $this->translation;
    }

    public function setTranslation(string $translation): self
    {
        $this->translation = $translation;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getScore(): ?int
    {
        return $this->score;
    }

    public function setScore(int $score): self
    {
        $this->score = $score;

        return $this;
    }
    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function setAuthor(?User $author): self
    {
        $this->author = $author;

        return $this;
    }
}
