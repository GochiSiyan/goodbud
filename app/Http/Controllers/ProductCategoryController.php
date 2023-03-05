<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\StoreProductCategoryRequest;
use App\Http\Requests\UpdateProductCategoryRequest;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Gate::allows('viewAny', ProductCategory::class)) {
            abort(403, 'Unauthorized action.');
        }
        $categories = ProductCategory::all();
        return response()->json(
            ProductCategory::all()
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductCategoryRequest $request)
    {
        $this->authorize('create', ProductCategory::class);
        $validated = $request->validated();
        $product_category = ProductCategory::create($validated);
        return response()->json([
            'message' => 'Product category was successfully created',
            'data' => $product_category
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function show(ProductCategory $productCategory)
    {
        $this->authorize('view', $productCategory);
        return response()->json($productCategory);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductCategoryRequest  $request
     * @param  \App\Models\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductCategoryRequest $request, ProductCategory $productCategory)
    {
        $this->authorize('update', $productCategory);
        $validated = $request->validated();
        $productCategory->update($validated);
        return response()->json([
            'message' => 'Product category was successfully updated',
            'data' => $productCategory
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductCategory $productCategory)
    {
        $this->authorize('delete', $productCategory);
        $productCategory->delete();
        return response()->json([
            'message' => 'Product category was successfully deleted',
            'data' => $productCategory
        ]);
    }
}
