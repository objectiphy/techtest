<?php

namespace App\Model\Service;

use App\Model\Request\QuoteRequest;

interface RatingProviderInterface
{
    public function getRatingFactor(QuoteRequest $quoteRequest): float;
}
