<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="quotation.abi_code_rating")
 */
class AbiCodeRatingFactor
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="string")
     */
    public string $abiCode;

    /**
     * @ORM\Column(type="decimal")
     */
    public float $ratingFactor;
}
