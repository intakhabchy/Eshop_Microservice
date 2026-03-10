<?php
namespace App\Repositories;

use App\Models\ProductReview;

class ProductReviewRepository
{
    public function createProductReview($data)
    {
        return ProductReview::create([
            'product_id' => $data['product_id'],
            'user_id' => $data['user_id'],
            'rating' => $data['rating'],
            'reviews' => $data['reviews'],
        ]);
    }
}