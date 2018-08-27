<?php 

if( isset( $_GET[ 'Login' ] ) ) { 
    // Get username 
    $user = $_GET[ 'username' ]; 

    // Get password 
    $pass = $_GET[ 'password' ]; 
    $pass = md5( $pass ); 

    // 并没有进行过滤
 /*
    1.输入：admin' or '1=1
    原句:select * from 'user' where user = 'admin' or '1=1' and password='';
    这句话的意思是先运行了or ,即判断user = 'admin'  和'1=1' and password=''是否存在一个为真，
    为真就可以执行查询。
    2.mysql注释符有三种：
							1、#... 输入:admin' #'
							2、"--  ..."输入：admin' -- ' 
							3、/*...*/ //一般不用这个		
    $query  = "SELECT * FROM `users` WHERE user = '$user' AND password = '$pass';"; 
    /*mysqli_query执行针对数据库的查询,
    返回True or False
    */
    $result = mysqli_query($GLOBALS["___mysqli_ston"],  $query ) or die( '<pre>' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)) . '</pre>' ); 
    //result==True，一个账户一个密码，所以查询结果只能等于1
    if( $result && mysqli_num_rows( $result ) == 1 ) { 
        // Get users details 
        $row    = mysqli_fetch_assoc( $result ); 
        /*mysqli_fetch_assoc()返回一个关联数组，
        其中包含了avatar这个字段，然后取出它的值赋给avatar
        */
       
        $avatar = $row["avatar"]; 

        // Login successful 
        echo "<p>Welcome to the password protected area {$user}</p>"; 
        echo "<img src=\"{$avatar}\" />"; 
    } 
    else { 
        // Login failed 
        echo "<pre><br />Username and/or password incorrect.</pre>"; 
    } 

    ((is_null($___mysqli_res = mysqli_close($GLOBALS["___mysqli_ston"]))) ? false : $___mysqli_res); 
} 

?> 