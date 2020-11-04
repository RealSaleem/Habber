<?php

namespace App\Repositories\Api;
use App\Events\UserRegisteredEvent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use DB;
use App\Business;
use Illuminate\Support\Facades\Auth;
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
        $user;
        $this->model->first_name = $data['first_name'];
        $this->model->last_name = $data['last_name'];
        $this->model->email = $data['email'];
        $this->model->password = Hash::make($data['password']);
        $this->model->language_id = $data['language_id'];
        $this->model->currency_id = 1;
        $this->model->status =  true;  
        if($this->model->save()) {
            if (Auth::attempt(['email' => $data['email'],'password' => $data['password'] ])) 
            {
                $user = Auth::user();
                if($user->status == true) {
                    $user['token'] = $user->createToken('token')->accessToken;
                }   
            }
            $name = $user->first_name .' '.$user->last_name;
            $email = $user->email;
            event(new UserRegisteredEvent($name, $email));
        }
      
        return $user;
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

    public function createJoinRequest(array $data)
    {
        $this->model->first_name = $data['name'];
        $this->model->email = $data['email'];
        $this->model->status =  false;  
        $this->model->phone = $data['phone'];
        $this->model->joining_request = 1;
        if($this->model->save()) {
            $business = new Business();
            $business->user_id = $this->model->id;
            $business->name = $data['name'];
            $business->business_type = $data['business_type'];
            $business->product_type = $data['product_type'];
            $business->details = $data['details'];
            $business->save(); 
        }
        return $this->model;
    }
}
