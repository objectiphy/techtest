<?php


namespace App\Model\Service;

use App\Entity\AbiCodeRatingFactor;
use App\Model\RatingFactorProviderInterface;
use App\Model\Request\QuoteRequest;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class AbiCodeRatingProvider implements RatingFactorProviderInterface
{
    private ObjectRepository $repository;
    private HttpClientInterface $httpClient;

    public function __construct(EntityManagerInterface $entityManager, HttpClientInterface $httpClient)
    {
        //Using the entity manager to get the repository saves a lot of dependency wiring
        $this->repository = $entityManager->getRepository(AbiCodeRatingFactor::class);
        $this->httpClient = $httpClient;
    }

    public function getRatingFactor(QuoteRequest $quoteRequest): float
    {
        //Look up ABI code via API (URL to hit would come from a config file or environment variable)
//        $abiResponse = $this->httpClient->request('get', 'http://www.example.com/abi?reg=' . $quoteRequest->regNo);
//        $abiCode = $abiResponse->getContent();
        $abiCode = '22529902';

        /** @var AbiCodeRatingFactor $abiCodeRating */
        $abiCodeRating = $this->repository->findOneBy(['abiCode' => $abiCode]);

        return $abiCodeRating->ratingFactor;
    }
}
