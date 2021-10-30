<?php

namespace Gglink\CrudPermission\Http\Controllers;

use App\Http\Controllers\Controller;
use Gglink\CrudPermission\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;
use Illuminate\Support\Facades\Validator;



class UserController extends Controller
{

    protected $service;
    public $userType;
    const moduleDirectory = 'crudPermission::users.';


    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct(UserService $userService)
    {
        // if user login is success then check user token exist with this middleware.
        //for now i keep it off because i can not login with the end point
       // $this->middleware('checkUserAuthenticate');
        $this->service = $userService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //get list of data and send to view
    public function index()
    {
        $data['users'] = $this->service->getData();
        return view(self::moduleDirectory.'index', $data);

        // real code
       /* $users = $this->service->getData();
        if ($users->successful()){
            $data['users'] = $users;
            return view(self::moduleDirectory.'index', $data);
        }elseif ($users->serverError()){
            session()->flash('error', 'Server Error');

        }else{
            session()->flash('error', 'Something went wrong ');
        }
        return redirect()->route('users.login.form');*/
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        return view(self::moduleDirectory.'create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    // save data
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'email' => 'required',
            'password' => 'required|min:6',
        ]);
        if ($validator->fails()) {
            return redirect(route('users.create'))
                ->withErrors($validator)
                ->withInput();
        }
        $user = $this->service->saveUser($request);
        if ($user->successful()){
            $request->session()->flash('success', 'Successfully saved');
        }elseif ($user->serverError()){
            $request->session()->flash('error', 'Server Error');
        }else{
            $request->session()->flash('error', 'Something went wrong ');
        }

        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //edit data
    public function edit($id)
    {
        $response = $this->service->getUserById($id);
        if ($response->successful()){
            $data['user'] = json_decode($response->body());
            return view(self::moduleDirectory.'edit', $data);

        }elseif ($response->serverError()){
            Session()->flash('error', 'Server Error');
        }else{
            Session()->flash('error', 'Something went wrong ');
        }

        return redirect()->route('users.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //update data
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'email' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect(route('users.edit', $id))
                ->withErrors($validator)
                ->withInput();
        }
        $response = $this->service->updateUser($request, $id);
        if ($response->successful()){
           $request->session()->flash('success', 'Successfully updated');
        }elseif ($response->serverError()){
           $request->session()->flash('error', 'Server Error');
        }else{
           $request->session()->flash('error', 'Something went wrong ');
        }

        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function deleteUser(Request $request){
        $response = $this->service->deleteUser($request->user_id);
        if ($response->successful()){
            $request->session()->flash('success', 'Successfully deleted');
        }elseif ($response->serverError()){
            $request->session()->flash('error', 'Server Error');
        }else{
            $request->session()->flash('error', 'Something went wrong ');
        }

        return redirect()->route('users.index');

    }
}
