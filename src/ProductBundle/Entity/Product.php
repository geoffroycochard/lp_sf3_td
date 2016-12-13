<?php

namespace ProductBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Product
 *
 * @ORM\Table(name="product")
 * @ORM\Entity(repositoryClass="ProductBundle\Repository\ProductRepository")
 */
class Product
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, unique=true)
     * @Assert\NotBlank()
     * @Assert\Length(min="6", max="255")
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="abstract", type="text", nullable=true)
     */
    private $abstract;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     * @Assert\NotBlank()
     */
    private $description;

    /**
     * @var Category
     *
     * @ORM\ManyToMany(targetEntity="ProductBundle\Entity\Category", inversedBy="products", cascade={"all"})
     */
    private $categories;

    /**
     * @var Variation
     *
     * @ORM\OneToMany(targetEntity="ProductBundle\Entity\Variation", mappedBy="product", cascade={"all"})
     */
    private $variations;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->categories = new \Doctrine\Common\Collections\ArrayCollection();
        $this->variations = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function __toString()
    {
        return $this->getTitle();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Product
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set abstract
     *
     * @param string $abstract
     *
     * @return Product
     */
    public function setAbstract($abstract)
    {
        $this->abstract = $abstract;

        return $this;
    }

    /**
     * Get abstract
     *
     * @return string
     */
    public function getAbstract()
    {
        return $this->abstract;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Product
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
     * Add category
     *
     * @param \ProductBundle\Entity\Category $category
     *
     * @return Product
     */
    public function addCategory(\ProductBundle\Entity\Category $category)
    {
        $this->categories[] = $category;

        return $this;
    }

    /**
     * Remove category
     *
     * @param \ProductBundle\Entity\Category $category
     */
    public function removeCategory(\ProductBundle\Entity\Category $category)
    {
        $this->categories->removeElement($category);
    }

    /**
     * Get categories
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * Add variation
     *
     * @param \ProductBundle\Entity\Variation $variation
     *
     * @return Product
     */
    public function addVariation(\ProductBundle\Entity\Variation $variation)
    {
        $this->variations[] = $variation;

        return $this;
    }

    /**
     * Remove variation
     *
     * @param \ProductBundle\Entity\Variation $variation
     */
    public function removeVariation(\ProductBundle\Entity\Variation $variation)
    {
        $this->variations->removeElement($variation);
    }

    /**
     * Get variations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getVariations()
    {
        return $this->variations;
    }
}
