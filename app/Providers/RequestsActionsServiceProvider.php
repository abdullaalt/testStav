<?php
namespace App\Providers;
 
use App\Contracts\V1\Requests\RequestsActionContract;
use App\Actions\V1\Requests\RequestsAction;

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

        RequestsActionContract::class => RequestsAction::class

    ];
}