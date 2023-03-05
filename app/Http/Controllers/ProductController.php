<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\ProductSearchRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ProductSearchRequest $request)
    {
        $validated = $request->validated();
        $query = Product::query();
        $query->with('productCategory');
        if (!Gate::allows('viewAny', ProductCategory::class)) {
            $query = $query->whereActive(true);
        }
        if (isset($validated['name'])) {
            $query->where('name', 'like', '%'.$validated['name'].'%');
            $query->orWhereHas('productCategory', function ($q) use ($validated) {
                $q->where('name', 'like', '%'.$validated['name'].'%');
            });
        }

        if (isset($validated['time'])) {
            $query->orderBy('created_at', $validated['time']);
        }

        if (isset($validated['price'])) {
            $query->orderBy('price', $validated['price']);
        }

        return response()->json($query->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        $this->authorize('create', ProductCategory::class);
        $product = Product::create($request->validated());
        return response()->json($product, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $this->authorize('view', ProductCategory::class);
        return response()->json($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $this->authorize('update', ProductCategory::class);
        $product->update($request->validated());
        return response()->json($product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $this->authorize('delete', ProductCategory::class);
        $product->delete();
        return response()->noContent();
    }
}
