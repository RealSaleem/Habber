<?php

namespace App\Repositories\Api;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Auth;
use Illuminate\Support\Facades\Log;

class UserRepository implements RepositoryInterface
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
    // public function all()
    // {
    //     return $this->model->get();
    // }

    public function getAllUsers($order_by = 'id', $sort = 'asc') {
        return $this->model::orderBy($order_by, $sort)->get();
    }
    public function updateStatus($id,$data) {
        return $this->model::where('id', $id)->updateOrCreate(['status' => 1]);
    }

    public function createInArray(array $data, Model $model)
    {
        $this->model = $model;
        return $this->model->insert($data);
    }

    // update record in the database
    public function update(array $data, $id)
    {
      
        $user = $this->model->findOrFail($id);
        $user->first_name = $data['first_name'];
        $user->last_name = $data['last_name'];
        $user->currency_id = $data['currency_id'];
        $user->language_id = $data['language_id'];
        if(isset($data['profile_pic'])) {
            Log::info($data['profile_pic']);
            Storage::disk('user_profile')->deleteDirectory('users/' . $id);
            $file = $data['profile_pic'];
            $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $filePath = "users/".$id.'/' . $fileName . time() . "." . $file->getClientOriginalExtension();
            $store = Storage::disk('user_profile')->put( $filePath, file_get_contents($file));
            $user->profile_pic = $filePath;
        }
        
        if(isset($data['phone'])) {
            $user->phone = $data['phone'];
        }
        $user->update();
        return $user;
    }

    public function passwordUpdate(array $data)
    {
        $user = $this->model->find(Auth::user()->id);
        $user->password = Hash::make($data['password']);
        $user->update();
        return true;
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

    public function all($with)
    {
        return $this->model->with($with)->get();
    }


    // create a new record in the database
    public function create(array $data)
    {
        $data['password'] = Hash::make($data['password']);
        $user =  $this->model->create($data);
        $user->assignRole('User');
        return $user;
    }

    public function createFavourite(array $data)
    {
        $data['user_id'] = Auth::user()->id;
        if ($data['product_type'] == 'book') {
            $fav =  $this->model->where('user_id',$data['user_id'])->where('book_id',$data['product_id'])->first();
            if(isset($fav)) {
                return 'exists';
           }
           else {
               $data['book_id'] = $data['product_id'];
                return $this->model->create($data);
           }
        }
        else if ($data['product_type'] == 'bookmark') {
            $fav =  $this->model->where('user_id',$data['user_id'])->where('bookmark_id',$data['product_id'])->first();
            if(isset($fav)) {
                return 'exists';
           }
           else {
               $data['bookmark_id'] = $data['product_id'];
                return $this->model->create($data);
           }
        }
    }

    public function getUserFavourites() 
    {
        $favourites = $this->model->with(['books','bookmarks'])->where('user_id',Auth::user()->id)->get();
        return $favourites;
    }

    public function deleteFavourite(array $data) 
    {
        if($data['product_type'] == "book") {
            $favourites = $this->model->where('user_id',auth()->user()->id)->where('book_id',$data['product_id'])->first();
            if(isset($favourites)) {
                $favourites->delete();
                return true;
            }
            else {
                return false;
            }
        }
        elseif ($data['product_type'] == "bookmark") {
            $favourites = $this->model->where('user_id',auth()->user()->id)->where('bookmark_id',$data['product_id'])->first();
            if(isset($favourites)) {
                $favourites->delete();
                return true;
            }
           else {
               return false;
           }
        }
    }
}