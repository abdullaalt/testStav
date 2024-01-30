<?php
namespace App\Services\V1\Requests;

use Illuminate\Support\Facades\File;

use App\Models\RequestsUsersBinds;

final class RequestsCommentsService extends RequestsService{

    public function addComment($request_id, $comment){

        RequestsUsersBinds::updateOrCreate([
            'request_id' => $request_id,
            'user_id' => request()->user()->id,
            'comment' => $comment
        ], [
            'request_id' => $request_id,
            'user_id' => request()->user()->id,
        ]);

        File::ensureDirectoryExists("emails");
        File::put("emails/".time().'.txt', $comment);

        return true;

    }

    public function deleteComment($request_id){

        RequestsUsersBinds::where('request_id', $request_id)->delete();

    }

}