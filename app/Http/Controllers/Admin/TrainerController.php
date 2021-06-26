<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Trainer;
use Auth;

class TrainerController extends Controller
{
    protected $label;
    public function __construct()
    {
        // $this->middleware('auth:admin');
        $this->label = 'Trainer';
    }
    public function index(Request $request)
    {
        $label = $this->label;
        $users = Trainer::whereNull('deleted_at')->get();
        return view('Admin.Trainers.list', compact('label', 'users'));
    }

    public function add(Request $request, $id = null)
    {
        try {
            if ($request->isMethod('GET')) {
                if ($id) {
                    $formLabel = 'Edit';
                    $user = Trainer::findorFail($id);
                } else {
                    $user = [];
                    $formLabel = 'Add';
                }
                $label = $this->label;
                return view('Admin.Trainers.add', compact('label', 'formLabel', 'user'));
            } else if ($request->isMethod('POST')) {
                $data = $request->all();
                $validator =  Validator::make($data, [
                    'name'          => 'required',
                    'user_name'     =>  'required',
                    'email'         => 'required|email|unique:trainers,email,' . @$data['id'] . ',id',
                    'phone_number'  => 'required',
                    'gym_name'      => 'required',
                    'dob'           => 'required',
                    'weight'        => 'required',
                    'height'        => 'required',
                    'status'        => 'required'
                ]);
                // dd($validator);
                if ($validator->fails()) {
                    return redirect()->back()->withInput()->withErrors($validator->errors());
                }
                // dd('if');
                $user = Trainer::where('id',$request['id'])->first();
                if ($request['id']) { 
                    $data['password'] = $user['password'];                  
                    $msz =  'Updated';
                } else {
                    $msz =  'Added';
                }
                $hash_password   = Hash::make(@$data['password']);
                $password        = str_replace("$2y$", "$2a$", @$hash_password);
                
                $users =  Trainer::addEdit($data, $password);
                $msz = $request['id'] ? 'Updated' : 'Added';
                return redirect('admin/trainer')->with(['success', 'Trainer ' . $msz . ' Successfully']);
            }
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function delete($id)
    {
        $delete = Trainer::where('id', $id)->update(['deleted_at'=>date('Y-m-d H:i:s')]);
        if ($delete) {
            return redirect()->back()->with('success', 'Trainer deleted successfully');
        } else {
            return redirect('admin/trainer')->with('error', 'Something went wrong, Please try again later.');
        }
    }
}