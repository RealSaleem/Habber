<?php

namespace App\Repositories\Api;
use App\Events\UserRegisteredEvent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use DB;
use Illuminate\Support\Facades\Hash;

class RegisterRepository implements RepositoryInterface
{
    // model property on class instances
    protected $model;

    // Constructor to bind model to repo
    public function __construct(Model $model)
    {
        // $this->$key = $model;
        $this->model = $model;
    }

    // Get all instances of model
    public function all($with)
    {
        return $this->model->with($with)->get();
    }

    // create a new record in the database
    public function create(array $data)
    {
        $this->model->first_name = $data['first_name'];
        $this->model->last_name = $data['last_name'];
        $this->model->email = $data['email'];
        $this->model->password = Hash::make($data['password']);
        $this->model->status =  true;  
        if($this->model->save()) {
            $name = $data['first_name'] .' '.$data['last_name'];
            $email = $this->model->email;
            event(new UserRegisteredEvent($name, $email));
        }
        return $this->model;
    }
    // Insert data in multiple rows
    public function createInArray(array $data, Model $model)
    {
        $this->model = $model;
        return $this->model->insert($data);
    }

    // update record in the database
    public function update(array $data, Model $model)
    {
        return $model->update($data);
    }

    // remove record from the database
    public function delete(Model $model)
    {
        return $model->delete();
    }

    // show the record with the given id
    public function show($id)
    {
        return $this->model->findOrFail($id);
    }

    // Get the associated model
    public function getModel()
    {
        return $this->model;
    }

    // Set the associated model
    public function setModel($model)
    {
        $this->model = $model;
        return $this;
    }

    // Eager load database relationships
    public function with($relations)
    {
        return $this->model->with($relations);
    }

    public function getAllUsers($order_by = 'id', $sort = 'asc') {
        return User::orderBy($order_by, $sort)->get();
    }
}
