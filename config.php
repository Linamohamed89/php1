 <?php


$host ='localhost';
$username ='root';
$password ='';
$dbname ='auth-system';


//1.Database connected.. 1 طريقه الاتصال مع قاعدة البيانات
$conn = new PDO("mysql:host=$host;dbname=$dbname;", $username, $password);


if($conn== true){
    echo "it's working fine";
}else{
    echo"connection is weong : err";
}

//2.Database connected..طريقه الاتصال مع قاعدة البيانات 2 
// $conn = new mysqli($host ,$username ,$password);

// if (!$conn){
//     echo "no connected";
// }else{
//     echo "connected successfully";
// }