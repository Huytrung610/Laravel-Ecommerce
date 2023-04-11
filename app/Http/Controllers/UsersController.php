<?php

namespace App\Http\Controllers;


use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\Rule;

class UsersController extends Controller
{
    const RULE_VALIDATE_COMMON = [
        'email' => 'required|string|unique:users',
        'role' => 'required|in:admin,user',
        'status' => 'required|in:active,inactive',
    ];

    public function index()
    {
        $users = User::orderBy('id', 'ASC')->get();
        return view('backend.users.index')->with('users', $users);
    }


    public function create()
    {
        return view('backend.users.create');
    }


    public function store(Request $request)
    {
        $isRoleCustomer = $request->get('role') === User::ROLE_TYPE_USER;
        $roleNew = ['password' => 'required|string'];
        $roleValidate = array_merge(self::RULE_VALIDATE_COMMON, $roleNew);
        if ($isRoleCustomer) {
            $roleValidate['customer_id'] = 'nullable|sometimes|unique:users';
        }
        $this->validate($request, $roleValidate);
        $data = $request->all();
        $data['name'] = $request->get('name');
        $data['password'] = Hash::make($request->get('password'));
        $status = User::create($data);
        if ($status) {
            request()->session()->flash('success', 'Successfully added user');
        } else {
            request()->session()->flash('error', 'Error occurred while adding user');
        }
        return redirect()->route('users.index');

    }

    public function edit($id)
    {
       
        $user       = User::findOrFail($id);
        // $gender     = array(
        //     'male'      => User::GENDER_MALE,
        //     'female'    => User::GENDER_FEMALE
        // );

        return view('backend.users.edit', [
            'user' => $user,
        ]);
    }

    public function update(Request $request, $id)
    {
        $isRoleCustomer = $request->get('role') === User::ROLE_TYPE_USER;
        $user = User::findOrFail($id);
        $roleValidate = self::RULE_VALIDATE_COMMON;
        $userEmail = $request->get('email');
        if ($user && $user->email == $userEmail) {
            $roleValidate['email'] = 'required|string';
        }
        $customerIdsIgnore = User::where('role', User::ROLE_TYPE_ADMIN)->pluck('id')->toArray();
        $customerIdsIgnore[] = $id;
        // $roleValidate['customer_id'] = [
        //     Rule::unique('users')
        //         ->where(function ($query) use ($request, $customerIdsIgnore) {
        //             $query->whereNotIn('id', $customerIdsIgnore)->where('customer_id', $request->get('customer_id'));
        //             return $query;
        //         })
        // ];
        // if ($isRoleCustomer) {
        //     $roleValidate['customer_id'] = [
        //         'required',
        //         Rule::unique('users')
        //             ->where(function ($query) use ($request, $customerIdsIgnore) {
        //                 $query->whereNotIn('id', $customerIdsIgnore)->where('customer_id', $request->get('customer_id'));
        //                 return $query;
        //             })
        //     ];
        // }
        $this->validate($request, $roleValidate);
        $data = $request->all();
        // $data['customer_id'] = $isRoleCustomer ? $request->get('customer_id') ?? $this->userHelper->generateUniqueCustomerId() : null;
        $data['name'] = $request->get("name");
        $status = $user->update($data);
        if ($status) {
            request()->session()->flash('success', 'Successfully updated');
        } else {
            request()->session()->flash('error', 'Error occurred while updating');
        }
        return redirect()->route('users.index');

    }

    public function destroy($id)
    {
        $delete = User::findorFail($id);
        $status = $delete->delete();
        if ($status) {
            request()->session()->flash('success', 'User Successfully deleted');
        } else {
            request()->session()->flash('error', 'There is an error while deleting users');
        }
        return redirect()->route('users.index');
    }
    
}
