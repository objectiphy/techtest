<?php

namespace App\Model;

use App\Model\Request\QuoteRequest;

interface RatingFactorProviderInterface
{
    public function getRatingFactor(QuoteRequest $quoteRequest): float;
}
