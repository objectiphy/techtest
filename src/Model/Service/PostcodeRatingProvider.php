<?php

namespace App\Model\Service;

use App\Entity\PostcodeRatingFactor;
use App\Model\RatingFactorProviderInterface;
use App\Model\Request\QuoteRequest;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;

class PostcodeRatingProvider implements RatingFactorProviderInterface
{
    private ObjectRepository $repository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        //Using the entity manager to get the repository saves a lot of dependency wiring
        $this->repository = $entityManager->getRepository(PostcodeRatingFactor::class);
    }

    public function getRatingFactor(QuoteRequest $quoteRequest): float
    {
        $postcodeArea = trim(substr($quoteRequest->postcode, 0, strlen($quoteRequest->postcode) - 3));

        /** @var PostcodeRatingFactor $postcodeRating */
        $postcodeRating = $this->repository->findOneBy(['postcodeArea' => $postcodeArea]);

        return $postcodeRating->ratingFactor;
    }
}
