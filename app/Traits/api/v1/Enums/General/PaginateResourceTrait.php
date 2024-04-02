<?php
declare(strict_types=1);

namespace App\Traits\api\v1\Enums\General;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

trait PaginateResourceTrait
{
    protected function paginateAndReturnResource(
        Request $request,
        mixed   $model,
        string  $resourceClass,
        array   $relations = []
    ): AnonymousResourceCollection
    {
        $perPage = $request->input('per_page', 10);
        $page = $request->input('page', 1);

        $query = is_string($model) ? (new $model)->query() : $model->query();

        $items = $query->with($relations)->paginate($perPage, ['*'], 'page', $page);

        return $resourceClass::collection($items);
    }
}
