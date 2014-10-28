<?php

/**
*用户信息表
*/

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
		    $table->increments('id');
		    $table->string("username",16);								// 数字账号
		    $table->string("nickname",30);								// 数字账号
			$table->string("email",40)->unique();						// 用户邮箱
            $table->string("password",60); 								// 密码
            $table->smallInteger('sex')->default('0');					// 性别 0女 1男 默认 0
			$table->integer("phone");									// 电话
			$table->string("region_id")->default('0');					// 注册地区 默认 0  －关联地区表
			$table->string("reg_device");								// 注册设备
			$table->string("reg_from");									// 统计项
			$table->string("lon",11);									// 经度
			$table->string("lat",11);									// 纬度
			$table->string("avatar",255);								// 头像图片
			$table->string("reset_password_token",255);					// 重置密码发送的标记
			$table->dateTime("reset_password_sent_at",255);				// 重置密码发送时间
			$table->dateTime("remember_created_at",255);				// 记住创建时间
			$table->integer("sign_in_count")->default('0');				// 登录总计次数 默认 0
			$table->dateTime("current_sign_in_at");						// 当前登录时间
			$table->dateTime("last_sign_in_at");						// 上次登录时间
			$table->string("current_sign_in_ip",255);					// 当前登录IP
			$table->string("last_sign_in_ip",255);						// 上次登录IP
			$table->integer("failed_attempts")->default('0');			// 失败尝试次数
			$table->string("unlock_token",255);							// 解锁口令
			$table->dateTime("locked_at");								// 锁定开始时间
			$table->integer("catepory")->default('0');					// 失败尝试次数 默认 0
			$table->mediumInteger("change_password_cnt")->default('0');	// 更改密码次数 默认 0
			$table->tinyInteger("modificatory")->default('0');			// 变更的 默认 0
			$table->integer("verified")->default('0');					// 更改密码次数 默认 0
			$table->timestamp("verified_at")->default('0000-00-00 00:00:00');// 更改密码次数 默认 0

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
		Schema::drop('users');
	}

}
