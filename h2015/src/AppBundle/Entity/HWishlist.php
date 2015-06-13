<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * HWishlist
 *
 * @ORM\Table(name="h_wishlist", indexes={@ORM\Index(name="fk_h_wishlist_h_products1_idx", columns={"h_products_id"})})
 * @ORM\Entity
 */
class HWishlist
{

    const REPOSITORY = 'AppBundle:HWishlist';

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="order", type="integer", nullable=true)
     */
    private $order;

    /**
     * @var string
     *
     * @ORM\Column(name="estimated_purchase", type="string", length=45, nullable=true)
     */
    private $estimatedPurchase;

    /**
     * @var \HProducts
     *
     * @ORM\ManyToOne(targetEntity="HProducts")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="h_products_id", referencedColumnName="id")
     * })
     */
    private $hProducts;



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
     * Set order
     *
     * @param integer $order
     * @return HWishlist
     */
    public function setOrder($order)
    {
        $this->order = $order;

        return $this;
    }

    /**
     * Get order
     *
     * @return integer 
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * Set estimatedPurchase
     *
     * @param string $estimatedPurchase
     * @return HWishlist
     */
    public function setEstimatedPurchase($estimatedPurchase)
    {
        $this->estimatedPurchase = $estimatedPurchase;

        return $this;
    }

    /**
     * Get estimatedPurchase
     *
     * @return string 
     */
    public function getEstimatedPurchase()
    {
        return $this->estimatedPurchase;
    }

    /**
     * Set hProducts
     *
     * @param \AppBundle\Entity\HProducts $hProducts
     * @return HWishlist
     */
    public function setHProducts(\AppBundle\Entity\HProducts $hProducts = null)
    {
        $this->hProducts = $hProducts;

        return $this;
    }

    /**
     * Get hProducts
     *
     * @return \AppBundle\Entity\HProducts 
     */
    public function getHProducts()
    {
        return $this->hProducts;
    }
}
