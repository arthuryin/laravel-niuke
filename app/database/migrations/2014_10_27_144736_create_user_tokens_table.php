<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTokensTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_tokens', function(Blueprint $table)
		{
		    $table->increments('id');
		    $table->integer("user_id");									// 关联users表 索引ID
		    $table->string("user_type",255);							// 用户类型
			$table->string("generate_device",30);						// 使用设备
            $table->string("token",255); 								// 口令
            $table->string('push_token',255);							// 推送口令

            $table->timestamps();
            $table->softDeletes();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('user_tokens');
	}

}
