<?php
/**
 * Created by PhpStorm.
 * User: hamdhanywijaya@gmail.com
 * Date: 8/26/17
 * Time: 10:18 PM
 */

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateNewUser;
use App\Models\UserRepository;
use App\Models\EventRepository;
use App\Models\RoleRepository;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Webpatser\Uuid\Uuid;
use Milon\Barcode\DNS2D;
use App\Models\RedisModel;
use Illuminate\Support\Facades\Redis;
use View;


class UsersController extends Controller
{
    protected $userRepo, $eventRepo;

    public function __construct(UserRepository $userRepo, EventRepository $eventRepo, RoleRepository $roleRepo)
    {
        $this->userRepo = $userRepo;
        $this->eventRepo = $eventRepo;
        $this->roleRepo = $roleRepo;
        $this->middleware('auth');
    }

    public function index()
    {
        View::share( 'page_state', 'Users' );
        return view('dashboard.admin.users.user_list')
                ->with('users', $this->userRepo->all());
    }
    public function create()
    {
        View::share( 'page_state', 'Users' );
        return view('dashboard.admin.users.user_add')
            ->with('users', $this->userRepo->all())
            ->with('events', $this->eventRepo->all())
            ->with('roles', $this->roleRepo->findWhereNotIn('name',['superadmin']));
    }
    public function createUserPost(CreateNewUser $request){
        $input = $request->input();
        $user = new User();
        $user->name = $input['name'];
        $user->email = $input['email'];
        $user->password = bcrypt($input['password']);
        $user->event_id = $input['event_id'];
        $user->save();
        $role_eo  = Role::find($input['role_id']);
        $user->roles()->attach($role_eo);
        $request->session()->flash('alert-success', 'User has been created !');
        return redirect()->route('dashboard.users');
    }
}
