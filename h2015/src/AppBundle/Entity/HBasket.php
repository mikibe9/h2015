<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * HBasket
 *
 * @ORM\Table(name="h_basket", indexes={@ORM\Index(name="fk_h_basket_h_products1_idx", columns={"h_products_id"})})
 * @ORM\Entity(repositoryClass="AppBundle\Repository\HBasketRepository")
 */
class HBasket
{
    const REPOSITORY = 'AppBundle:HBasket';
    const STATUS_ACTIVE = 'active';
    const STATUS_INACTIVE = 'inactive';
    const STATUS_DELETED = 'deleted';

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
     * @ORM\Column(name="quantity", type="integer", nullable=true)
     */
    private $quantity;

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
     * @var string
     *
     * @ORM\Column(name="status", type="string", nullable=false)
     */
    private $status;

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
     * Set quantity
     *
     * @param integer $quantity
     *
     * @return HBasket
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return integer
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set hProducts
     *
     * @param \AppBundle\Entity\HProducts $hProducts
     *
     * @return HBasket
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

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }
}
