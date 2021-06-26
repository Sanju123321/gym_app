<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\User;
use Auth;

class UsersController extends Controller
{
    protected $label;
    public function __construct()
    {
        // $this->middleware('auth:admin');
        $this->label = 'User';
    }
    public function index(Request $request)
    {
        $label = $this->label;
        $users = User::whereNull('deleted_at')->get();
        return view('Admin.Users.list', compact('label', 'users'));
    }

    public function add(Request $request, $id = null)
    {
        try {
            if ($request->isMethod('GET')) {
             
                if ($id) {
                    $formLabel = 'Edit';
                    $user = User::findorFail($id);

                } else {
                    $user = [];
                    $formLabel = 'Add';
                }
                $label = $this->label;
                return view('Admin.Users.add', compact('label', 'formLabel', 'user'));
            } else if ($request->isMethod('POST')) {
                $data = $request->all();
            
                $validator =  Validator::make($data, [
                    'user_name'     =>  'required',
                    'email'         => 'required|email|unique:users,email,' . @$data['id'] . ',id',
                    'phone_number'  => 'required',
                    'status'        => 'required'
                ]);
                if ($validator->fails()) {
                     return redirect()->back()->withInput()->withErrors($validator->errors());
                }
 

                $user = User::where('id',$request['id'])->first();
                
                if ($request['id']) {                   
                    $msz =  'Updated';
                } else {
                    $msz =  'Added';
                }
                        
                $hash_password   = Hash::make(@$data['password']);
                $password        = str_replace("$2y$", "$2a$", @$hash_password);
                $users =  User::addEdit($data,$password);
                $msz = $request['id'] ? 'Updated' : 'Added';
                return redirect('admin/user')->with(['success', 'User ' . $msz . ' Successfully']);
            }
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function delete($id)
    {
        $delete = User::where('id', $id)->update(['deleted_at'=>date('Y-m-d H:i:s')]);
        if ($delete) {
            return redirect()->back()->with('success', 'User deleted successfully');
        } else {
            return redirect('admin/user')->with('error', 'Something went wrong, Please try again later.');
        }
    }
}