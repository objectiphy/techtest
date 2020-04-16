<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="quotation.age_rating")
 */
class AgeRatingFactor
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     */
    public int $age;

    /**
     * @ORM\Column(type="decimal")
     */
    public float $ratingFactor;
}
