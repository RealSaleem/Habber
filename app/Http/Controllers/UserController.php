<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {
        $user = User::all();
        return view('users.index', compact('user'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $validatedData = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|unique:users|email',
            'password' => 'required|min:8',
            'phone' => 'required|numeric',  
        ]);
        $user = new User();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->phone = $request->phone;
        $user->save();   
        return redirect('/users/create')->with('success', 'User successfully saved');

    }
    
    /**
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
  
{

}
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    

    }
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $validatedData = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'password' => 'required|min:8',
            'phone' => 'required|numeric',  
        ]);
        $user = User::find($id);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->password = Hash::make($request->password);
        $user->phone = $request->phone;
        $user->save();
        $user->update($request->all());
        return back()->with('success', 'User updated sucessfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $user = User::findOrFail($id);
        $user->delete();
        return back()->with('success', 'User deleted successfully');
    
        
    }
    
}