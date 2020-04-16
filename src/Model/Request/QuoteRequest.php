<?php

namespace App\Model\Request;

use Symfony\Component\Validator\Constraints as Assert;

class QuoteRequest
{
    /**
     * @var int
     * @Assert\NotBlank()
     * @Assert\Type("int")
     */
    public int $age;

    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Regex("/^([A-Z][A-HJ-Y]?[0-9][A-Z0-9]? ?[0-9][A-Z]{2}|GIR ?0A{2})$/")
     */
    public string $postcode;

    /**
     * @var string
     * @Assert\NotBlank()
     */
    public string $regNo;
}
