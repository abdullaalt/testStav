<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\NotificationsController;

class RequestsUsersBinds extends Model{

    public $timestamps = true;
	
	protected $fillable = ['request_id', 'user_id', 'comment'];

}