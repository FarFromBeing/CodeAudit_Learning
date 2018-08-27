之前看了一个写新手如代码审计的坑的paper,觉得感触很深。
[http://http://www.freebuf.com/articles/web/166602.html](http://http://www.freebuf.com/articles/web/166602.html)

先从简单的代码审计入手，那就是DVWA了。

----------


**总体目标：**

1. 熟悉积累常用的特征函数
2. 对数据的流向有认识
3. 后期再加...

----------


**Brute Force**

ps：mysql -h localhost -uroot



- Level Low

这个级别没什么函数需要注意的，没有过滤，直接撸就是了。

PHP中的三种数组：

    
> 1.数值数组：数字ID键的数组

>   2.关联数组：类似key-value

    $age=array("Peter"=>"35","Ben"=>"37","Joe"=>"43");
    $age['Peter']="35";
    $age['Ben']="37";
    $age['Joe']="43";
> 3.多维数组：包含一个或多个数组的数组
        
