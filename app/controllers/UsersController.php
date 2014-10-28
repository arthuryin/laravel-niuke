<?php

class UsersController extends BaseController {



	public function index()
	{
		return View::make('home.index');
	}

	public function register()
	{
		return View::make('home.userRegister');
	}

}
