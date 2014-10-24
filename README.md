
# niuke_laravel 开发之道

### 环境搭建（虚拟机）
* 下载安装virtualbox  地址：<https://www.virtualbox.org/wiki/Downloads>
* 下载安装vagrant 地址：<http://www.vagrantup.com/downloads.html>
* 将homestead_v1.box移动到C盘根目录，添加box，在任意目录下运行：

	```
	vagrant box add niuke/homestead /c/homestead_v1.box

	```
	* 修改该文件	C:\Users\Arthur\vagrant\niuke_homestead\scripts 下的 homestead.rb文件：

	```
	  改成这样：
    # Configure The Box
    config.vm.box = "niuke/homestead"
    config.vm.hostname = "niuke"
	```
* 克隆Homestead仓库
	
	```
	mkdir ~/vagrant
	cd ~/vagrant
	git clone https://github.com/senlaner/homestead.git niuke_homestead
	
	```
* 设置你的SSH密钥 
	```
	ssh-keygen -t rsa -C "your@email.com"
	```
* 编辑Homestead.yaml

	```
	vi ~/vagrant/topka_homestead/Homestead.yaml
	```

	```
	ip: "192.168.10.100" #内网ip，不用改
	memory: 1024		#设置内存大小
	cpus: 1

	authorize: /Users/me/.ssh/id_rsa.pub #公钥地址，改成自己的

	keys:
	    - /Users/me/.ssh/id_rsa #私钥地址，改成自己的

	folders:
	    - map: /Users/me/code #共享目录
	      to: /home/vagrant/code #虚拟机对应的目录

	sites:
	    - map: topka.dev #虚拟主机
	      to: /home/vagrant/code/laravel-topka/public #对应地址


	variables:
	    - key: APP_ENV
	      value: local
		
	```
	vim 替换代码，{user_name}为当前用户名，不清楚的略过
	
	```
	%s/\/me\//\/{user_name}\//
	```
	
* clone 代码 

	```
	cd ~/code
	git clone git@git.hezuo.tk:php/laravel-topka.git
	```

* 设置本地storage文件权限

	```
	chmod -R 777 ~/code/laravel-topka/app/storage
	```
	
* 启动虚拟机

	```
	cd ~/vagrant/topka_homestead/
	vagrant up # 关于vagrant命令 请自行 vagrant --help
	```
* 设置本地host
	
	```
	127.0.0.1  niuke.dev api.niuke.dev static.niuke.dev image.niuke.dev
	```
* 访问，在8000端口上

	```
	http://niuke.dev:8000/
	```
* 如果想在80端口上访问，则可以设置host：``` 192.168.10.100  niuke.dev api.niuke.dev static.niuke.dev image.niuke.dev ```

* 访问虚拟机

	```
	ssh vagrant@127.0.0.1 -p 2222 #如果使用密码密码，则密码也是 vagrant
	```
* 更多内容请参见：<http://v4.golaravel.com/docs/4.2/homestead>

### 关于开发框架 laravel 
官方文档：<http://www.golaravel.com/> 

在使用前请先通读数据库章节 <http://v4.golaravel.com/docs/4.2/database> 中：基本用户、查询构造器和Eloquent ORM三小结内容。

laravel 提供了很多脚手架工具：<http://v4.golaravel.com/docs/4.2/artisan>

```	
php artisan list # 列出所有可用的Artisan命令
php artisan generate:model Post # 创建一个名为Post的model
```

laravel 提供了很多工具函数，建议事先了解一遍：<http://v4.golaravel.com/docs/4.2/helpers>

其他内容可以边用边阅读文档

### 给Model的任意方法到结果添加缓存

在需要添加缓存到方法内部前端加上一下代码

```
if(!$this->cached)
    return $this->cache(__FUNCTION__,func_get_args());

```

如：Brand.php 到 dealers 方法。


```
public function dealers($city_id)
    {

    	if(!$this->cached)
    		return $this->cache(__FUNCTION__,func_get_args());

    	$res = DealerBrand::where("brand_id",$this->id)->get();
    	$dealer_ids = array();
    	foreach ($res as $k => $v) {
    		$dealer_ids[] = $v->dealer_id;
    	}
    	if(!$dealer_ids)
    		return [];
    	return Dealer::whereIn("id",$dealer_ids)->where("status",1)->where("city_id",$city_id)->get();
    	
    }

```

### 参数不能为空校验

* 单参数不能为空

```
if(!Input::has('model_id'))
	return Result(0,'参数错误');
$model_id = Input::get('model_id');
```

* 多参数不能为空

```
$required = ['city_id','model_id'];
if(!Input::exists($required))
{
	return Result(0,'参数错误');
}

extract(Input::only($required));
// 或者
$params = Input::only($required);

```


### 如何开发api
TODO
 
### 关于Composer
composer是php的一个包管理工具，laravel框架使用的正是此工具

官方网址：<https://getcomposer.org/>

虚拟机当中已经安装好了composer工具，在虚拟机的项目跟目录中就可以直接使用，如：

```
composer update
```
composer 的配置文件为项目根目录下的：``` composer.json ``` ，一般只需要修改require下的内容，各个包的官方文档中也会由如何install包的文档。

composer 的包列表查询地址： <https://packagist.org/>



###测试用例开发

phpunit安装
sudo pear channel-discover pear.phpunit.de
sudo pear channel-discover pear.symfony-project.com
sudo pear channel-discover components.ez.no
sudo pear channel-discover pear.symfony.com
sudo pear install pear.symfony.com/Yaml
sudo pear install --alldeps phpunit/PHPUnit

使用：
phpunit app/tests/AutodataTest.php
注意：
	 测试类 继承 TestCase
	 测试方法名必须以test开始
