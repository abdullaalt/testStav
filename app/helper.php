<?php

	use Illuminate\Support\Facades\DB;
	use Illuminate\Support\Facades\Auth;
	use App\Http\Controllers\UserController;
	use App\Http\Controllers\BehaviorController;

	use App\Services\V1\Rules\RulesService;

	function clearString($str){

		$patterns = array();
		$patterns[] = '/\s?<script[^>]*?>.*?<\/script>\s?/si';
		$patterns[] = '/\s?script.*?\/script\s?/si';
		$patterns[] = '/expression\(document.write/si'; 
		$patterns[] = '/document.write/si';
		$patterns[] = '/document.cookie.escape/si';
		$patterns[] = '/document.cookie/si';

		$str = preg_replace($patterns, '', $str); 

		return $str;
	}

	function savePermissions($request, $item){
		foreach ($request->permissions as $key => $permission) {
			
			$item['group_id'] = $permission['group_id'];
			$item['rules'] = $permission['rules_id'];
			RulesService::save($item);

		}
	}

	function dateFormat($date){
		return date('d.m.Y', strtotime($date));
	}

	function dateTimeFormat($date){
		return date('d.m.Y H:i', strtotime($date));
	}
	
	function getImageSrc($arr, $size, $alt='', $default = 'upload/default/avatar_{#}.svg'){

		$images = json_decode($arr);
			
		if (is_object($images)){
			$images = (array)json_decode($arr);
		}
		if (isset($images[$size])){
			return '/storage/app/'.clearString($images[$size]);
		}else{
			return '/storage/app/'.clearString($default);
		}
		
	}

	function print_image_src($arr, $size, $alt='', $default = 'upload/default/avatar_{#}.svg', $path = '/storage/app/'){

		if (!$arr){
			return null;
		}
		
		$images = is_string($arr) ? json_decode($arr) : $arr;

		return $path.clearString($images->{$size});
		
	}

	function print_images_src($arr, $alt='', $default = 'upload/default/avatar_{#}.svg', $path = '/storage/app/'){

		if (!$arr){
			return false;
		}

		$images = json_decode($arr);

		$result = [];

		foreach ($images as $key => $image) {
			$result[$key] = $path.$image;
		}

		return $result;
		
	}
	
	function fileMimeType($media){

		if (!$media){
			return null;
		}

		$way = storage_path('app/'.$media); 
				
		$mime = @mime_content_type ($way);

		$type = explode('/', $mime);
		return $type[0];
		
	}

	
	function orderBy(array &$array, $sortOrder){
		usort($array, function ($a, $b) use ($sortOrder) {
			$result = '';

			$sortOrderArray = explode(',', $sortOrder);
			foreach ($sortOrderArray AS $item) {
				$itemArray = explode(' ', trim($item));
				$field = $itemArray[0];
				$sort = !empty($itemArray[1]) ? $itemArray[1] : '';

				$mix = [$a, $b];
				if (!isset($mix[0][$field]) || !isset($mix[1][$field])) {
					continue;
				}

				if (strtolower($sort) === 'desc') {
					$mix = array_reverse($mix);
				}

				if (is_numeric($mix[0][$field]) && is_numeric($mix[1][$field])) {
					$result .= ceil($mix[0][$field] - $mix[1][$field]);
				} else {
					$result .= strcasecmp($mix[0][$field], $mix[1][$field]);
				}
			}

			return $result;
		});

		return $array;
	}