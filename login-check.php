<?php 
// mengaktifkan session pada php
session_start();
 
// menghubungkan php dengan koneksi database
include 'dbconnect.php';
 
// menangkap data yang dikirim dari form login
$username = $_POST['loginUsername'];
$password = $_POST['loginPassword'];
  
// menyeleksi data user dengan username dan password yang sesuai
$loginData = mysqli_query($connection,"SELECT * FROM user INNER JOIN role ON user.id_role=role.role_id WHERE npk_user='$username' AND password_user=md5($password)");

//Menghitung jumlah row untuk crosscheck database
$check = mysqli_num_rows($loginData);
if($check > 0){
	$AR_loginData = mysqli_fetch_assoc($loginData);
	$id_role = $AR_loginData['id_role'];
	$roleData = mysqli_query($connection,"SELECT * FROM role WHERE role_id = $id_role");
	$AR_roleData = mysqli_fetch_assoc($roleData);

	// $progressSumary = mysqli_query($connection, "SELECT * FROM summary");
	// $AR_summaryData = mysqli_fetch_assoc($progressSumary);

	// $_SESSION['summaryIssued'] = $AR_summaryData['issued'];
	// $_SESSION['summaryNeedRevise'] = $AR_summaryData['need_revise'];
	// $_SESSION['summaryApproved'] = $AR_summaryData['approved'];

	//For Common User
    if($AR_roleData['role_name']!='Superuser'){
        // buat session login dan username
		$_SESSION['username'] = $username;
		$_SESSION['name'] = $AR_loginData['nama_user'];
		$_SESSION['role'] = $AR_roleData['role_name'];
		$_SESSION['loginStatus'] = "Loggedin";
		//Alihkan ke Dashboard Common User
		header("location:index.php");
	
	//For Superuser
    }else {
		//Refer to Superuser Dashboard
		header("location:index1.html");
	}

}

else{
	header("location:login.php");
}
 
?>