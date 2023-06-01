<?php

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface BaseInterface {

   public function create(array $attributes): Model;

    public function fetchAll(): Collection;

    public function findById(int $id): Model;

   public function update(array $params, int $id): Model;

   public function delete(int $id): bool;

}
