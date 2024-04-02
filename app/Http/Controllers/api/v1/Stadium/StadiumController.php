<?php

namespace App\Http\Controllers\api\v1\Stadium;

use App\Http\Controllers\Controller;
use App\Http\Resources\api\v1\Stadium\StadiumResource;
use App\Models\Stadium;
use App\Traits\api\v1\Enums\General\PaginateResourceTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class StadiumController extends Controller
{
    use PaginateResourceTrait;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        return $this->paginateAndReturnResource(
            request: $request,
            model: Stadium::class,
            resourceClass: StadiumResource::class,
            relations: ['address']
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Stadium $stadium)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Stadium $stadium)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Stadium $stadium)
    {
        //
    }
}
