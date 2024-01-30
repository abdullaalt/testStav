<?php

namespace App\Services\V1\Users;

use App\Models\Org;
use App\Models\OrgInfo;
use App\Models\User;
//use App\Models\instCard;
use App\Services\V1\Orgs\ProjectsService;
use App\Services\V1\News\NewsService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Services\V1\Orgs\OrgsService;

/*
 * 
 */
class UsersService{

    protected function generatePassword($password){
        return Hash::make($password);
    }

    protected function createUser($user){
        $user = User::create($user);
        return $user->id;
    }

    public function isAdmin($user_id = false){

        $user_id = $user_id ? $user_id : Auth::id();
        //$group = 

    }

    public function getUser($user_id = false, $get_admin_data = true){

        $user = User::find($user_id);
        
        if ($user->group_id == 2){
            $org = (new OrgsService())->getOrgById($user->org_id)->fillOrgInfo()->get();
        }else{
            $org = false;
        }

        $result = [];
        $result['user'] = $user;
        $result['org'] = $org;
        $result['projects'] = (new ProjectsService())->getMyProjectsList();
        $result['news'] = (new NewsService())->getMyNewsList();

        return $result;

    }

    protected function auth($user_id){
        $user = User::where('id', $user_id)->first();
        $result = [
			'token' => $user->createToken('gos')->plainTextToken,
            'user' => $this->getUser($user_id)
        ];
        return $result;
    }

}