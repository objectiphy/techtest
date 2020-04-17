<?php

namespace App\Model\Service;

use App\Entity\AgeRatingFactor;
use App\Model\Request\QuoteRequest;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;

class AgeRatingProvider implements RatingProviderInterface
{
    private ObjectRepository $repository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        //Using the entity manager to get the repository saves a lot of dependency wiring
        $this->repository = $entityManager->getRepository(AgeRatingFactor::class);
    }

    public function getRatingFactor(QuoteRequest $quoteRequest): float
    {
        /** @var AgeRatingFactor $ageRating */
        $ageRating = $this->repository->findOneBy(['age' => $quoteRequest->age]);
        return $ageRating->ratingFactor;
    }
}
