<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('regions', function(Blueprint $table)
		{
		    $table->increments('id');									// 索引ID
		    $table->string("zone_name",64);								// 国家省份地区名字
		    $table->string("coding");							 		// 地区的代码标示
			$table->string("ancestry",100);								// 国家省份级联路径
			$table->integer("ancestry_depth")->default('0');			// 级联等级 国家0 省份1 市2
            $table->string("initial"); 									// 首字母大写
            $table->tinyInteger('is_capital')->default('0');			// 是否是首都 默认 0 
            $table->integer('status')->default('0');					// 任务状态 默认 0
            $table->dateTime('last_task_added_at');						// 最后添加任务时间
            $table->dateTime('last_task_success_at');					// 最后成功任务时间
            $table->dateTime('last_task_error_at');						// 最后错误任务时间
			
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
		Schema::dorp('regions');
	}

}
