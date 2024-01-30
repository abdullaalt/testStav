<?php

namespace App\Http\Controllers\V1;

use App\Models\Tarif;
use App\Models\UsersTarifsBind;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Cookie;

use App\Http\Controllers\V1\Controller;

use App\Services\V1\Users\GroupsService;
use App\Services\V1\Users\UsersService;
use App\Services\V1\Users\GosuslugiService;
use App\Services\V1\Users\GUService;
use App\Services\V1\API\SitesService;

use App\Http\Resources\V1\UserResource;
use App\Http\Resources\V1\ContentResource;
use App\Http\Resources\V1\ContentListResource;

use App\Services\V1\Rules\PermissionsService;

//use App\Models\instConProf;

class UserController extends Controller {

    public function profile(UsersService $us, SitesService $ss){

        if (!Auth::check()){
            return view('error404', [
                'message' => 'Пользователь не найден'
            ]);
        }

        $data = $us->getUser(Auth::id());

        return view('actions.profile', [
            'page_title' => 'Профиль - '.@$data['org']->full_name,
            'data' => $data,
            'tarifs' => Tarif::all(),
            'current' => UsersTarifsBind::where("user_id", Auth::id())->first()->tarif,
            'sites' => $ss->getSitesList(),
            'domains' => $ss->getDomainsList()
        ]);

    }

    public function getUserPermissions(PermissionsService $ps){
        return $ps->getUserPermissions();
    }

    public function authGosUslugi(Request $request, GUService $gs){

        return $gs->init($request);

    }

    public function webAuthGosUslugi(Request $request, GUService $gs){
		
		return $gs->init($request);
        // $data = $gs->init($request);
        // $token = $data['token'];

        // return redirect('/')->withCookie(
            // 'token', $token, 3600, '/', 'crm.kod06.ru', true, false
        // );

    }

}