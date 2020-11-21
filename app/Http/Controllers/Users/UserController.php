<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

use Avatar;

use App\User;

class UserController extends Controller
{
    public function filter (Request $request)
    {
        $query = User::query();

        if($request->search) {
            $query->where('name', 'LIKE', '%'.$request->search.'%');
        }

        $users = $query->orderBy($request->input('orderBy.column'), $request->input('orderBy.direction'))
                    ->paginate($request->input('pagination.per_page'));

        $users->load('roles');

        return $users;
    }

    public function show ($user)
    {
        return User::findOrFail($user);
    }

    public function store (Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string',
            'unit' => 'required|array',
            'roles' => 'required|array'
        ]);
        $input = $request->all();
        $input['password'] = Hash::make($request->password);
        $user = new User();
        $user->name = $input['name'];
        $user->email = $input['email'];
        $user->password = Hash::make($request->password);
        $user->unit = implode(array_pluck($request->unit, ['unit_name']));
        $user->role_name = implode(array_pluck($request->roles, ['display_name']));
        $user->save();
        $rolesNames = array_pluck($request->roles, ['name']);
        $user->assignRole($rolesNames);

        $avatar = Avatar::create($user->name)->getImageObject()->encode('png');
        Storage::put('avatars/'.$user->id.'/avatar.png', (string) $avatar);

        return $user;
    }
    public function getUnits(){
        return DB::table('units')->select('unit_name')->get();
    }

    public function update (Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,'.$request->id,
            'password' => 'string|nullable',
            'roles' => 'required|array'
        ]);

        $user = User::find($request->id);

        if ($user->name != $request->name) {
            $avatar = Avatar::create($request->name)->getImageObject()->encode('png');
            Storage::put('avatars/'.$user->id.'/avatar.png', (string) $avatar);
            $user->name = $request->name;
        }
        if ($user->email != $request->email) {
            $user->email = $request->email;
        }
        if ($request->password != '') {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        $rolesNames = array_pluck($request->roles, ['name']);
        $user->syncRoles($rolesNames);

        return $user;
    }

    public function destroy ($user)
    {
        return User::destroy($user);
    }

    public function count ()
    {
        return User::count();
    }

    public function getUserRoles ($user)
    {
        $user = User::findOrFail($user);
        $user->getRoleNames();

        return $user;
    }


}
