<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "phoneBookProject";


// Create connection

$conn = mysqli_connect($servername, $username, $password, $dbname);
$conn->set_charset("utf8"); 
// Check connection
if (!$conn) {
    
    die("Connection failed: " . mysqli_connect_error());
}

if (!empty($_POST['name']) || !empty($_POST['address']) || !empty($_POST['number']) ) {
    if (preg_match("/^(966)(5)[0-9]{8}$/", $_POST['number']) || preg_match("/^(05)[0-9]{8}$/", $_POST['number']) || preg_match("/^(966)(13)[0-9]{7}$/", $_POST['number']) || preg_match("/^(013)[0-9]{7}$/", $_POST['number']) || preg_match("/^(966)(9200)[0-9]{5}$/", $_POST['number']) || preg_match("/^(9200)[0-9]{5}$/", $_POST['number'])){
        $sql = "INSERT INTO phonebook (name , address , number) VALUES ('$_POST[name]' , '$_POST[address]' , '$_POST[number]')";
    }else{
        header("location: insert.php?error=wrongphoneformat&status=&data=");
        exit();
    }
}else{
    header("location: insert.php?error=emptyfields&status=&data=");
    exit();
}

if (mysqli_query($conn, $sql)) {

        if (empty($_POST['name']) || empty($_POST['address']) || empty($_POST['number']) ) {
            header("location: insert.php?error=emptyfields&status=&data=");
            exit();
        }
        else{
            header("location:insert.php?status=success&data=");
        }


} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>