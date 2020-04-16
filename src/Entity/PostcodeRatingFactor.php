<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="quotation.postcode_rating")
 */
class PostcodeRatingFactor
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="string", name="postcode_area")
     */
    public string $postcodeArea;

    /**
     * @ORM\Column(type="decimal")
     */
    public float $ratingFactor;
}
