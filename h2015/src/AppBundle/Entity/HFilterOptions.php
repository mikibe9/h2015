<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * HFilterOptions
 *
 * @ORM\Table(name="h_filter_options", indexes={@ORM\Index(name="fk_h_filter_options_h_filters1_idx", columns={"h_filters_id"}), @ORM\Index(name="fk_h_filter_options_h_options1_idx", columns={"h_options_id"})})
 * @ORM\Entity
 */
class HFilterOptions
{

    const REPOSITORY = 'AppBundle:HFilterOptions';

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="option_value", type="string", length=45, nullable=true)
     */
    private $optionValue;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", nullable=false)
     */
    private $status;

    /**
     * @var \HFilters
     *
     * @ORM\ManyToOne(targetEntity="HFilters")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="h_filters_id", referencedColumnName="id")
     * })
     */
    private $hFilters;

    /**
     * @var \HOptions
     *
     * @ORM\ManyToOne(targetEntity="HOptions")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="h_options_id", referencedColumnName="id")
     * })
     */
    private $hOptions;



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
     * Set optionValue
     *
     * @param string $optionValue
     * @return HFilterOptions
     */
    public function setOptionValue($optionValue)
    {
        $this->optionValue = $optionValue;

        return $this;
    }

    /**
     * Get optionValue
     *
     * @return string 
     */
    public function getOptionValue()
    {
        return $this->optionValue;
    }

    /**
     * Set status
     *
     * @param string $status
     * @return HFilterOptions
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
     * Set hFilters
     *
     * @param \AppBundle\Entity\HFilters $hFilters
     * @return HFilterOptions
     */
    public function setHFilters(\AppBundle\Entity\HFilters $hFilters = null)
    {
        $this->hFilters = $hFilters;

        return $this;
    }

    /**
     * Get hFilters
     *
     * @return \AppBundle\Entity\HFilters 
     */
    public function getHFilters()
    {
        return $this->hFilters;
    }

    /**
     * Set hOptions
     *
     * @param \AppBundle\Entity\HOptions $hOptions
     * @return HFilterOptions
     */
    public function setHOptions(\AppBundle\Entity\HOptions $hOptions = null)
    {
        $this->hOptions = $hOptions;

        return $this;
    }

    /**
     * Get hOptions
     *
     * @return \AppBundle\Entity\HOptions 
     */
    public function getHOptions()
    {
        return $this->hOptions;
    }
}
