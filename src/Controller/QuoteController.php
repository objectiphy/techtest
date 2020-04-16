<?php

namespace App\Controller;

use App\Model\Request\QuoteRequest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use App\Model\Service\QuoteService;

class QuoteController extends AbstractController
{
    private Request $request;
    private Serializer $serializer;
    private ValidatorInterface $validator;
    private QuoteService $quoteService;
    private array $errors = [];

    public function __construct(
        Request $request,
        Serializer $serializer,
        ValidatorInterface $validator,
        QuoteService $quoteService
    ) {
        $this->request = $request;
        $this->serializer = $serializer;
        $this->validator = $validator;
        $this->quoteService = $quoteService;
    }

    public function getQuote(): JsonResponse
    {
        /** @var QuoteRequest $quoteRequest */
        $quoteRequest = $this->serializer->deserialize(
            $this->request->getContent(),
            QuoteRequest::class,
            'json'
        );

        if ($this->isQuoteRequestValid($quoteRequest)) {
            $quote = $this->quoteService->getQuote($quoteRequest);
            return $this->json($quote);
        } else {
            return $this->json($this->errors, Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Typically, I would abstract this out to provide generic validation for any request, perhaps in a
     * base controller class.
     * @param QuoteRequest $quoteRequest
     * @return bool
     */
    private function isQuoteRequestValid(QuoteRequest $quoteRequest): bool
    {
        $this->errors = [];
        $violations = $this->validator->validate($quoteRequest);
        if ($violations->count() > 0) {
            foreach ($violations as $violation) {
                $this->errors[$violation->getPropertyPath()] = $violation->getMessage();
            }

            return false;
        }

        return true;
    }
}
