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
        
**Command Injection**

- Level High

其实比较坑，仔细看才知道High级别是留了“|”给注入的，它禁用的是“| ”。

`trim()`移除字符，默认直接移除以下：
> "\0" - NULL
> 
> "\t" - 制表符
> 
> "\n" - 换行
> 
> "\x0B" - 垂直制表符
> 
> "\r" - 回车
> 
> " " - 空格

今天在研究绕过其黑名单的时候对trim()有点疑惑，为什么|net user能被执行，中间不是存在空格么？

测试：输入框内的值作为字符串传入trim，并不会执行去除,则这个函数存在的意义是什么？

之前查W3C，并没有直接说是前后去除，结果查资料才知道，是去除收尾的一些符号，之前测试都是中间的符号...

所以说high级别可以用|net user 进行注入，没毛病。

测试代码：

    
    <?php
    $target = trim('   hellopoi');
    echo "<pre>{$target}</pre>"; 
    ?>

测试结果：

![](https://i.imgur.com/3o93iQD.png)        

**XSS-Reflect**
今天进行DVWA XSS测试发现个有趣的事。
> DVWA1.9
> 
> PHP7.2.5
> 
> chrome latest version


在high级别进行测试的测试的时候，顺利弹框，显示cookie

![](https://i.imgur.com/2laH60n.png)

但是自己重新改了一小部分内容，放到XAMPP环境下，使用相同的Chrome就被拦截了，猜想是不是DVWA是不是对Chrome进行了修改，使其开放一些脚本的加载。

![](https://i.imgur.com/lgsHd9Z.png)