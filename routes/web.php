<?php


use App\Http\Controllers\V1\UserController;
use App\Http\Controllers\V1\ContentController;
use App\Http\Controllers\V1\ProjectsController;
use App\Http\Controllers\V1\FilesController;
use App\Http\Controllers\V1\NewsController;
use App\Http\Controllers\V1\EventsController;
use App\Http\Controllers\V1\SitesController;

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get("/testload", function () {
     $file_local = Storage::disk('public')->path('testfile.txt');
     //dd($file_local);
     $file = Storage::disk('ftp')->putFile('/test.abdulla-alt.ru/public_html/',  $file_local);
     echo $file;
});

Route::prefix('profile')->group(function(){
     Route::get('/', [UserController::class, 'profile']);
});

Route::prefix('files')->group(function(){
     Route::get('/{hash}', [FilesController::class, 'load'])->name('download_file');
});

Route::middleware('access:domain_add')->prefix('domains')->group(function(){
     Route::middleware('auth')->group(function(){
          Route::get('/add', [SitesController::class, 'add'])->name('domain_add');
          Route::post('/add', [SitesController::class, 'store'])->name('domain_store');
     });
});

Route::prefix('news')->group(function(){

     Route::get('/', [NewsController::class,'getNewsList'])->name('news_list');

     Route::middleware('access')->group(function(){
          Route::get('/add', [NewsController::class,'addNews'])->name('news_add');
          Route::get('/{news_id}/delete', [NewsController::class,'delete'])->name('news_delete');
          Route::get('/{news_id}/edit', [NewsController::class,'edit'])->name('news_edit');
          Route::post('/store', [NewsController::class, 'store'])->name('news_store');
     });

     Route::get('/{news_id}', [NewsController::class,'getNews'])->name('news_item');
});

Route::prefix('events')->group(function(){

     Route::get('/', [EventsController::class,'getEventsList'])->name('events_list');

     Route::middleware('access')->group(function(){
          Route::get('/add', [EventsController::class,'addEvent'])->name('event_add');
          Route::get('/{event_id}', [EventsController::class,'getEvent'])->name('event_item');
          Route::get('/{event_id}/delete', [EventsController::class,'delete'])->name('event_delete');
          Route::get('/{event_id}/edit', [EventsController::class,'edit'])->name('event_edit');
          Route::post('/store', [EventsController::class, 'store'])->name('event_store');
     });
});


Route::prefix('projects')->group(function(){

     Route::middleware('access')->group(function(){
          Route::get('/my', [ProjectsController::class, 'myProjects'])->name('projects');
          Route::get('/{project_id}/news/add', [ProjectsController::class, 'addNewsForProject'])->name('add_news_for_project');
          Route::get('/{project_id}/project/add', [ProjectsController::class, 'addEventForProject'])->name('add_event_for_project');

          Route::get('/{project_id}/delete', [ProjectsController::class, 'delete'])->name('project_delete');
          Route::get('/{project_id}/edit', [ProjectsController::class, 'edit'])->name('project_edit');
 
          Route::get('/create', [ProjectsController::class, 'create'])->name('project_create_get');
          Route::post('/store', [ProjectsController::class, 'store'])->name('project_create');
     });

     Route::get('/', [ProjectsController::class, 'projects'])->name('projects');
     Route::get('/{project_id}', [ProjectsController::class, 'project'])->name('project');

 });

Route::post('/orgs', [ContentController::class, 'storeOrgs']);

Route::get('/hello', function (Request $request) {
    return 'hello';
});

Route::get('/', [NewsController::class,'getNewsList'])->name('news_list');

Route::fallback(function(){
	return view('main');
});

Route::get('/auth/gosuslugi', [UserController::class, 'webAuthGosUslugi']);


require __DIR__.'/auth.php';
