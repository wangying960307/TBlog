# TBlog前端

## 简介
该博客是个人在课余时间基于vuejs、element-ui、d2admin、thinkphp框架进行开发，在此先感谢以上开源项目的无私奉献，
如果我的项目对你有用，劳驾给我一个star吧，如果有招开发的公司劳烦联系邮箱gtguizhou@qq.com。
~~~
|-- 文章模块（完成）
| |-- 增、删、查、改（完成）
| |-- 点赞功能 （完成）
| |-- 从内容中抽取标签
| |-- 文章分组
| |-- 自定义标签
|
|-- 文件模块
| |-- 上传文件（当前可上传：图片）
| |-- 下载文件（完成50%）
| |-- 文件管理
| |-- 文件分组
|
|-- 音乐模块
| 
|-- 微博模块（对外隐藏）
| |-- 增、删、查、改（完成）
| |-- 从内容中抽取标签
| |-- 自定义标签
|
|-- 系统配置模块
| |-- 配置指定key即可读、写
| |-- 配置回滚
~~~

## 博客关联开源项目
[博客前端](https://github.com/GtGuiZhou/TBlogVue)
[博客管理前端](https://github.com/GtGuiZhou/TBlogAdminVue)
[博客后台(php)](https://github.com/GtGuiZhou/TBlog)

## 2019年02月07日12:19:40
今天写了上传功能，上传功能需要注意的一点是，上传成功后生成的url为
{domain}/api/upload这个方法

## 2019年02月08日12:19:47
由于restfull的路由写法，容易造成路由解析误判，所以放弃使用restfull的Url写法。
例如
get方法的article/:id => article/index/read会导致
get方法的article/indexOfTrashed解析为上述路由
虽然可以指定id为数字类型，使得路由解析正确，但是万一以后id是字符串类型呢？
所以放弃了restfull的路由写法

## 2019年02月08日14:30:31
### php的另一种遍历方法
current：用来获取数组当前项
next:用来将数组内部的指针指向下一项
key:用来获取当前项的指针
~~~
<?php
$array = array(
    'fruit1' => 'apple',
    'fruit2' => 'orange',
    'fruit3' => 'grape',
    'fruit4' => 'apple',
    'fruit5' => 'apple');

// this cycle echoes all associative array
// key where value equals "apple"
while ($fruit_name = current($array)) {
    if ($fruit_name == 'apple') {
        echo key($array).'<br />';
    }
    next($array);
}
?>
~~~
## 2019年02月08日14:54:21
发现v5.1.34的thinkphp框架软删除有问题，进行了修正

## 2019年02月08日15:14:16
发现thinkphp框架的软删除字段时间不会自动转换，所以要手动转换
~~~
  public function getDeleteTimeAttr($value)
   {
       return date('Y-m-d H:i:s',$value);
   }
~~~

## 软删除——坑
如果update操作中含有delete_time字段导致，更新数据变成了删除数据

软删除会调用模型的save方法，对delete_time字段进行修改，所有不建议重写save方法，而是用模型事件before_insert代替。

## 闭包——坑
| 版本        | 更新内容    |  可否在匿名函数中使用$this  |
| --------   | -----:   | :----: |
| >=7.1.0        | 闭包可以从父作用域中继承变量。 任何此类变量都应该用 use 语言结构传递进去。 PHP 7.1 起，不能传入此类变量： superglobals、 $this 或者和参数重名。      |   N    |
| >=5.4.0        | $this 可用于匿名函数。      |   Y    |
| >=5.3.0        | 可以使用匿名函数。      |   N    |

7.1后不能使用$this了，也找不到方法在匿名方法中使用$this

## app_debug = true显示异常信息
在开发程序的时候开启app_debug会出现这种错误提示，把app_debug = false就行啦
![avatar](./public/static/image/QQ图片20190213183323.png)
