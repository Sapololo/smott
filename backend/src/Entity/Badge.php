<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class Badge
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    public $id;

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=50, nullable=false)
     */
    public $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=250, nullable=false)
     */
    public $slug;

    /**
     * @var string|null
     *
     * @ORM\Column(name="contenu", type="string", length=250, nullable=true, options={"default"="NULL"})
     */
    public $contenu = 'NULL';

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=false)
     */
    public $description;

  /**
   * @return int
   */
  public function getId(): int {
    return $this->id;
  }

  /**
   * @param int $id
   */
  public function setId(int $id): void {
    $this->id = $id;
  }

  /**
   * @return string
   */
  public function getTitre(): string {
    return $this->titre;
  }

  /**
   * @param string $titre
   */
  public function setTitre(string $titre): void {
    $this->titre = $titre;
  }

  /**
   * @return string
   */
  public function getSlug(): string {
    return $this->slug;
  }

  /**
   * @param string $slug
   */
  public function setSlug(string $slug): void {
    $this->slug = $slug;
  }

  /**
   * @return null|string
   */
  public function getContenu(): ?string {
    return $this->contenu;
  }

  /**
   * @param null|string $contenu
   */
  public function setContenu(?string $contenu): void {
    $this->contenu = $contenu;
  }

  /**
   * @return string
   */
  public function getDescription(): string {
    return $this->description;
  }

  /**
   * @param string $description
   */
  public function setDescription(string $description): void {
    $this->description = $description;
  }

}
