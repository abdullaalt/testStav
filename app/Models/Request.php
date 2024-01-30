<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\NotificationsController;

class Request extends Model{

    public $timestamps = true;
	
	protected $fillable = ['email', 'name', 'status', 'message'];

}