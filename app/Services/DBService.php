<?php

namespace App\Services;

use DB;

class DBService
{

	public function checkConnection()
	{
		try {
		    DB::connection()->getPdo();
			return true; 
		} catch (\Exception $e) {
		    return false;
		}
	}

}