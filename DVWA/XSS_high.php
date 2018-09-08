<?php 

header ("X-XSS-Protection: 0"); 

// Is there any input? 
/*array_key_exists("name",$_GET)检查数组$_GET中是否存在name的key
*/
if( array_key_exists( "name", $_GET ) && $_GET[ 'name' ] != NULL ) { 
/*preg_replace()执行一个正则表达式的搜索和替换
这里是通过一个正则来把GET[ 'name' ]中的script相关标签，替换成空格
*/
    $name = preg_replace( '/<(.*)s(.*)c(.*)r(.*)i(.*)p(.*)t/i', '', $_GET[ 'name' ] ); 

    // Feedback for end user 
    echo "<pre>Hello ${name}</pre>"; 
} 

?> 