<?php

namespace App\Services\api\v1;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class ApiService implements ApiServiceInterface
{
    public function __construct(
        public readonly Model $model,
        public readonly Request $request,
    )
    {
    }

    public function index()
    {
        return $this->model->all();
    }

    public function store(array $data)
    {
        return $this->model->create($data);
    }

    public function show(Model $model)
    {
        return $this->model->findOrFail($model);
    }

    public function update(Model $model, array $data)
    {
        $record = $this->model->findOrFail($model);
        $record->update($data);
        return $record;
    }

    public function destroy(Model $model)
    {
        $record = $this->model->findOrFail($model);
        $record->delete();
        return $record;
    }
}

