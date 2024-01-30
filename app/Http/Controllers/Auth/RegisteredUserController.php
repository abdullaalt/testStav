<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Org;
use App\Models\OrgInfo;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Str;
use App\Models\Content;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
		
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'management_fio' => ['required', 'string', 'max:255'],
            'management_post' => ['required', 'string', 'max:255'],
            'full_name' => ['required', 'string', 'max:255'],
            'short_name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'inn' => ['required', 'string', 'max:255'],
            'kpp' => ['required', 'string', 'max:255'],
            'ogrn' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()]
        ]);
        
        $org = [
            'title' => $request->short_name
        ];

        $org = Org::create($org);

        $info = $request->all();
        $info['org_id'] = $org->id;

        $info = OrgInfo::create($info);

        $user = User::create([
            'nickname' => $request->short_name,
            'phone' => $request->phone,
            'email' => $request->email,
            'org_id' => $org->id,
            'group_id' => 2,
            'password' => Hash::make($request->password)
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::PROFILE);
    }
}
