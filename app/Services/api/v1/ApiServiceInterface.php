<?php

namespace App\Services\api\v1;

use Illuminate\Database\Eloquent\Model;

interface ApiServiceInterface
{
    public function index();

    public function show(Model $model);

    public function store(array $data);

    public function update(Model $model, array $data);

    public function destroy(Model $model);
}
