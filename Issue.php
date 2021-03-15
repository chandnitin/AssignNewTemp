<?php 
require_once('config/DbConn.php');
$obj = DbConn::getConnect();
$baseurl = 'http://localhost/assignment/';

$urlParams = explode('/', $_SERVER['REQUEST_URI']);

$functionName = $urlParams[3];
echo  $functionName($urlParams[4]);


 function checkDublicate(){
    $subject = trim($_POST['subject']);
    return   DbConn::getCount('SELECT subject FROM issue WHERE  subject="'.$subject.'" AND is_deleted=0');
  
}

function store(){  
   $imgpath = uploadFiles($_FILES);
   $param = array(
       'issue_id'       =>  DbConn::getLastIssueID('CR', 'CR%'),
       'subject'        =>  $_POST['subject'],
       'description'    =>  $_POST['discription'],
       'status'         =>  $_POST['status'],
       'priority'       =>  $_POST['priority'],
       'region'         =>  implode(', ', $_POST['regions']),
       'due_date'       =>   date("Y-m-d", strtotime($_POST['duedate'])) ,
       'assignee'       =>  $_POST['assignee'],
       'reviewer'       =>  $_POST['reviewer'],
       'version'        =>  $_POST['targetversion'],
       'reviewer_comment' =>  $_POST['reviewercomment'],
       'image_path'     =>  $imgpath,
       'is_deleted'     => 0,
       'created_at'     => date('Y-m-d H:i:s'),
   );
   
   if(DbConn::createInsertSQL('issue',$param)){
        header("Location: http://localhost/assignment/list.php"); 
   }else{
        header("Location: http://localhost/assignment/form.html"); 
   }
}

function uploadFiles($files){
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($files["imagephoto"]["name"]);
    $uploadOk = 1;
     $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $check = getimagesize($files["imagephoto"]["tmp_name"]);
    if($check !== false) {
       
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
     
      } else {
        if (move_uploaded_file($files["imagephoto"]["tmp_name"], $target_file)) {
         return $files["imagephoto"]["name"];
        } else {
          echo "Sorry, there was an error uploading your file.";
        }
    }

}


function deleteIssue(){
  
   $rparm=array('is_deleted'=>1);
   return  DbConn::createUpdateSQL('issue',$rparm,"issue_id in(".$_POST['issueids'].")");

}




 
?>
