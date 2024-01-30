<?php

	use Illuminate\Support\Facades\DB;
	use Illuminate\Support\Facades\Auth;
	use App\Http\Controllers\UserController;
	use App\Http\Controllers\BehaviorController;

	use App\Services\V1\Rules\RulesService;

	function dateFormat($date){
		return date('d.m.Y', strtotime($date));
	}

	function dateTimeFormat($date){
		return date('d.m.Y H:i', strtotime($date));
	}