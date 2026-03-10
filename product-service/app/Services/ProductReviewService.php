<?php
namespace App\Services;

use App\Repositories\ProductReviewRepository;

class ProductReviewService
{
    private $productReviewRepo;

    public function __construct(ProductReviewRepository $productReviewRepo)
    {
        $this->productReviewRepo = $productReviewRepo;
    }

    public function create($data)
    {
        return $this->productReviewRepo->createProductReview($data);
    }
}