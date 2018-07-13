<?php
namespace app\common\controller;

class Base extends Controller
{
	protected $request;
    
	public function __construct(Request $request)
    {
    	$this->uid = Session::set('$this->id');
    }
}