<?php 

if( isset( $_POST[ 'Submit' ]  ) ) { 
    // Get input 
    $target = $_REQUEST[ 'ip' ]; 

// Set blacklist 
/*利用：windows和Linux都可以使用&&来进行多命令执行
这里只禁止了&&,没有禁止&
&:先后执行，前条命令执行成功与否都不会影响第二条命令
&&:前条成功，再执行后一条
直接构造:
127.0.0.1&ipconfig
&net user
*/
    $substitutions = array( 
        '&&' => '', 
        ';'  => '', 
    ); 

    // Remove any of the charactars in the array (blacklist). 
    //str_replace()将target ip中的&& ;两个字符替换成他们所对应的value
    $target = str_replace( array_keys( $substitutions ), $substitutions, $target ); 

    // Determine OS and execute the ping command. 
    //stristr() 函数搜索'Windows NT'在另一字符串中的第一次出现。
    //php_uname()这个函数会返回运行php的操作系统的相关描述
    if( stristr( php_uname( 's' ), 'Windows NT' ) ) { 
        // Windows 
        $cmd = shell_exec( 'ping  ' . $target ); 
    } 
    else { 
        // *nix 
        $cmd = shell_exec( 'ping  -c 4 ' . $target ); 
    } 

    // Feedback for the end user 
    echo "<pre>{$cmd}</pre>"; 
} 

?> 