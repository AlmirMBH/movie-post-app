<?php

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Model;

interface BaseInterface{

   public function create($attributes);

    public function fetchAll();

    public function findById($id);

   public function update($params, $id);

   public function delete($id);

}
