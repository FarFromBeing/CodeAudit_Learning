<?php 

if( isset( $_POST[ 'Submit' ]  ) ) { 
/*trim()移除字符，默认直接移除以下：
"\0" - NULL
"\t" - 制表符
"\n" - 换行
"\x0B" - 垂直制表符
"\r" - 回车
" " - 空格
*/
    $target = trim($_REQUEST[ 'ip' ]); 

/*黑名单进行了改变*/
/*只能使用|
直接构造：
|
*/
    $substitutions = array( 
        '&'  => '', 
        ';'  => '', 
        '| ' => '', 
        '-'  => '', 
        '$'  => '', 
        '('  => '', 
        ')'  => '', 
        '`'  => '', 
        '||' => '', 
    ); 

    // Remove any of the charactars in the array (blacklist). 
    $target = str_replace( array_keys( $substitutions ), $substitutions, $target ); 

    // Determine OS and execute the ping command. 
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
