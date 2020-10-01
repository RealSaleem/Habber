<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

interface RepositoryInterface
{

    public function all(array $with);

     /**
     * @param string $order_by
     * @param string $sort
     * @return mixed
     */
    
    
    public function create(array $data);

    public function update(array $data, Model $model);

    public function delete(Model $model);

    public function show(Model $model);

}
