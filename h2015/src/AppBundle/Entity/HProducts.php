<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Repository\HProductsRepository;

/**
 * HProducts
 *
 * @ORM\Table(name="h_products", indexes={@ORM\Index(name="fk_h_products_h_brands_idx", columns={"h_brands_id"}), @ORM\Index(name="fk_h_products_h_categories1_idx", columns={"h_categories_id"})})
 * @ORM\Entity(repositoryClass="AppBundle\Repository\HProductsRepository")
 */
class HProducts
{
    const REPOSITORY = 'AppBundle:HProducts';

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var integer
     *
     * @ORM\Column(name="price", type="integer", nullable=true)
     */
    private $price;

    /**
     * @var integer
     *
     * @ORM\Column(name="discount", type="integer", nullable=true)
     */
    private $discount;

    /**
     * @var integer
     *
     * @ORM\Column(name="delivery_estimated_cost", type="integer", nullable=true)
     */
    private $deliveryEstimatedCost;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", nullable=false)
     */
    private $status;

    /**
     * @var \HBrands
     *
     * @ORM\ManyToOne(targetEntity="HBrands")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="h_brands_id", referencedColumnName="id")
     * })
     */
    private $hBrands;

    /**
     * @var \HCategories
     *
     * @ORM\ManyToOne(targetEntity="HCategories")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="h_categories_id", referencedColumnName="id")
     * })
     */
    private $hCategories;


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
     * Set name
     *
     * @param string $name
     *
     * @return HProducts
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set price
     *
     * @param integer $price
     *
     * @return HProducts
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
     * Set discount
     *
     * @param integer $discount
     *
     * @return HProducts
     */
    public function setDiscount($discount)
    {
        $this->discount = $discount;

        return $this;
    }

    /**
     * Get discount
     *
     * @return integer
     */
    public function getDiscount()
    {
        return $this->discount;
    }

    /**
     * Set deliveryEstimatedCost
     *
     * @param integer $deliveryEstimatedCost
     *
     * @return HProducts
     */
    public function setDeliveryEstimatedCost($deliveryEstimatedCost)
    {
        $this->deliveryEstimatedCost = $deliveryEstimatedCost;

        return $this;
    }

    /**
     * Get deliveryEstimatedCost
     *
     * @return integer
     */
    public function getDeliveryEstimatedCost()
    {
        return $this->deliveryEstimatedCost;
    }

    /**
     * Set status
     *
     * @param string $status
     *
     * @return HProducts
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set hBrands
     *
     * @param \AppBundle\Entity\HBrands $hBrands
     *
     * @return HProducts
     */
    public function setHBrands(\AppBundle\Entity\HBrands $hBrands = null)
    {
        $this->hBrands = $hBrands;

        return $this;
    }

    /**
     * Get hBrands
     *
     * @return \AppBundle\Entity\HBrands
     */
    public function getHBrands()
    {
        return $this->hBrands;
    }

    /**
     * Set hCategories
     *
     * @param \AppBundle\Entity\HCategories $hCategories
     *
     * @return HProducts
     */
    public function setHCategories(\AppBundle\Entity\HCategories $hCategories = null)
    {
        $this->hCategories = $hCategories;

        return $this;
    }

    /**
     * Get hCategories
     *
     * @return \AppBundle\Entity\HCategories
     */
    public function getHCategories()
    {
        return $this->hCategories;
    }
}
