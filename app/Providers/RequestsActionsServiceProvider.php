<?php
namespace App\Providers;
 
use App\Contracts\V1\Requests\RequestsActionContract;
use App\Actions\V1\Requests\RequestsAction;

use App\Contracts\V1\Requests\RequestActionContract;
use App\Actions\V1\Requests\RequestAction;

use App\Contracts\V1\Requests\StoreActionContract;
use App\Actions\V1\Requests\StoreAction;

use App\Contracts\V1\Requests\DeleteActionContract;
use App\Actions\V1\Requests\DeleteAction;

use App\Contracts\V1\Requests\MyRequestsActionContract;
use App\Actions\V1\Requests\MyRequestsAction;

use Illuminate\Support\ServiceProvider;
 
class RequestsActionsServiceProvider extends ServiceProvider
{
    /** 
* Bootstrap the application services. 
* 
* @return void 
*/
    public function boot()
    {
        // 
    }
 
    /** 
* Register the application services. 
* 
* @return void 
*/
    public array $bindings = [

        DeleteActionContract::class => DeleteAction::class,
        StoreActionContract::class => StoreAction::class,
        RequestsActionContract::class => RequestsAction::class,
        RequestActionContract::class => RequestAction::class,
        MyRequestsActionContract::class => MyRequestsAction::class

    ];
}