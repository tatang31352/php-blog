<?php
namespace App\Validates\Admin;

class PassportValidate
{
	public function login($value)
    {
    	if($value["username"] > 200)
    	{
    		return 666;
    	}else
    	{
    		return 555;
    	}
    }
}