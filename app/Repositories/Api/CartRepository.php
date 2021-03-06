<?php
namespace App\Repositories\Api;
use App\Genre;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;


class CartRepository implements RepositoryInterface {
    protected $model;

    // Constructor to bind model to repo
    public function __construct(Model $model)
    {
        // $this->$key = $model;
        $this->model = $model;
    }

    public function all($with)
    {
        return $this->model->with($with)->where('user_id',auth()->user()->id)->orderBy('created_at', 'desc')->first();;
    }

    // create a new record in the database
    public function create(array $data)
    {
        $temp=0;
        $temp1=0;
        $books =  [];
        $bookmarks = [];
        $arr['user_id'] = auth()->user()->id;
        $arr['total_price'] = $data['total_price'];
        $cart = $this->model->create($arr);
       $price = [];
       $price1= [];
        foreach($data['product'] as $i) {
            if( $i['product_type'] == "book") {
                array_push($books, $i);
                array_push($price,$i['price']*$i['quantity']);
            }
            else {
                array_push($bookmarks ,$i);
                array_push($price1,$i['price']*$i['quantity']);
            }
        }

    //    dd($books[0]['product_id']);
        if(count($books) > 0) {
        
            for($i = 0; $i < count($books); $i++) {
                $cart->books()->attach($books[$i]['product_id'], ['quantity' => $books[$i]['quantity'] , 'price' => $books[$i]['price'],'product_type' => $books[$i]['product_type'] ]);
                //$price->books()->attach($books[$i]['quantity'] * $books[$i]['price'] , $books[$i]['product_type']);
            }
        }
        if(count($bookmarks) > 0) {
            for($i = 0; $i < count($bookmarks); $i++) {
                $cart->bookmarks()->attach($bookmarks[$i]['product_id'],['quantity' => $bookmarks[$i]['quantity'] , 'price' => $bookmarks[$i]['price'],'product_type' => $bookmarks[$i]['product_type'] ]);
                //$price->bookmarks()->attach($bookmarks[$i]['quantity']*$bookmarks[$i]['price'] , $books[$i]['product_type']);
            }
        }
        if(count($price)>0){
            foreach($price as $p1){
                $temp+=$p1;
            }}
      
            if(count($price1)>0){
             foreach($price1 as $p){
            $temp1+=$p;
        }}
    $t=$temp+$temp1;
        $arr['total_price'] = $t;
        return $cart;

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
        // dd($model);
        $temp=0;
        $temp1=0;
        $books =  [];
        $bookmarks = [];
        $arr['total_price'] = $data['total_price'];
        $model->update($arr);
        $model->books()->detach();
        $model->bookmarks()->detach();
        $price= [];
        $price1= [];
        foreach($data['product'] as $i) {
            if( $i['product_type'] == "book") {
                array_push($books, $i);
                array_push($price,$i['price']*$i['quantity']);
            }
            else {
                array_push($bookmarks ,$i);
                array_push($price1,$i['price']*$i['quantity']);
            }
        }
        if(count($books) > 0) {
        
            for($i = 0; $i < count($books); $i++) {
               $model->books()->attach($books[$i]['product_id'], ['quantity' => $books[$i]['quantity'] , 'price' => $books[$i]['price'],'product_type' => $books[$i]['product_type'] ]);
               // $model1->books()->attach($books[$i]['quantity']*$books[$i]['price']);
            }
        }
        if(count($bookmarks) > 0) {
            for($i = 0; $i < count($bookmarks); $i++) {
               $model->bookmarks()->attach($bookmarks[$i]['product_id'],['quantity' => $bookmarks[$i]['quantity'] , 'price' => $bookmarks[$i]['price'],'product_type' => $bookmarks[$i]['product_type'] ]);
               // $model1->bookmarks()->attach($bookmarks[$i]['quantity']*$bookmarks[$i]['price']);
            }
        }
         if(count($price)>0){
            foreach($price as $p1){
                $temp+=$p1;
            }}
      
            if(count($price1)>0){
             foreach($price1 as $p){
            $temp1+=$p;
        }}
    $t=$temp+$temp1;
        $arr['total_price'] = $t;
        $model->update($arr);
        return $model;
        // return $model->update($data);
    }

    // remove record from the database
    public function delete(Model $model)
    {

        $model->books()->detach();
        $model->bookmarks()->detach();
        return $model->delete();
    }

    public function deleteUserCart($id) {
        $this->model->where('user_id')->first();
        $this->model->books()->detach();
        $this->model->bookmarks()->detach();
        return $this->model->delete();
    }
    // show the record with the given id
    public function show($id)
    {
        return $this->model->findOrFail($id);
    }
     
    public function userCart($id) {
        return $this->model->where('user_id',$id)->first();
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

    public function bookSearch($data) {
        return $this->model->orWhere('title', 'like', "%{$data}%")->orWhere('author_name','like',"%{$data}%")->orWhere('description','like',"%{$data}%")->where('status',1)->get();
    }

    public function filterByGenre($data) {
        if(is_array($data)) {
            $genres = Genre::with('books')->whereIn('title',$data)->get();
            
            
            $books = [];
           
            if(count($genres) > 1) {
              
                for ($i = 0; $i < count($genres); $i++) {
                    $books = $genres[$i]->books->where('status',1);
                }   
                return $books;
            }
            else {
                return $genres[0]->books->where('status',1);
            }
           
           
        }
        else {
            $genres = Genre::with('books')->where('title',$data)->get();
            if(count($genres) > 1) {
                for ($i = 0; $i < count($genres); $i++) {
                    $books = $genres[$i]->books->where('status',1);
                }   
                return $books;
            }
            else {
                return $genres[0]->books->where('status',1);
            }
        }
       
    }
}