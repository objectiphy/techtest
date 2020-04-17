<?php

namespace App\Model\Service;

use App\Model\Request\QuoteRequest;
use App\Entity\Quote;

class QuoteService
{
    private array $ratingFactorProviders = [];

    public function addRatingFactor(RatingProviderInterface $ratingFactorProvider)
    {
        $this->ratingFactorProviders[] = $ratingFactorProvider;
    }

    public function getQuote(QuoteRequest $quoteRequest): Quote
    {
        $quote = new Quote();
        $quote->premium = 500; //Would normally come from the database

        foreach ($this->ratingFactorProviders as $ratingFactorProvider) {
            $quote->premium *= $ratingFactorProvider->getRatingFactor($quoteRequest);
        }
        $quote->premium = round($quote->premium, 2);

        return $quote;
    }
}
