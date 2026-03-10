<?php

namespace App\Http\Controllers;

use App\Models\ProductReview;
use Illuminate\Http\Request;

class ProductReviewController extends Controller
{

    public function store(Request $request)
    {
        return ProductReview::create($request->all());
    }
}
