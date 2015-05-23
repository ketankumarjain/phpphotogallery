<?php
use entity\Photograph;

include_once"../models/Interactor/db/MySqlQueryEngine.php";
include_once"../models/Interactor/PhotoGraphDAO.php";
include_once"../models/entity/Photograph.php";
include_once "../models/utility/CommanFunction.php";
include_once "../services/Session.php";
/*if (!$session->is_logged_in()) {     redirect_to("http://localhost/photo_gallery/AdminIdex.html");
}*/

$target_dir = "D:/wamp/www/phpphotogallery/uploadedimage/";
 $target_file= $target_dir.basename($_FILES['fileToUpload']['name']);;
 $imageFileType=pathinfo($target_file, PATHINFO_EXTENSION); ;
 $uploadOk = 1;

        if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES['fileToUpload']['tmp_name']);

            $temp_path  = $_FILES['fileToUpload']['tmp_name'];
            if ($check !== null) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;

            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }
        if(file_exists($target_file)){
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }
        if($uploadOk==1) {
            if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_file)) {
                $Photograph=new Photograph();
                $Photograph->setFilename(basename($_FILES['fileToUpload']['name']));
                $Photograph->setType($_FILES['fileToUpload']['type']);
                $Photograph->setSize($_FILES['fileToUpload']['size']);
                $Photograph->setCaption( $_POST['caption']);
                $Photograph->setPath($target_file);
                $PhotographDAO=new \Interactor\PhotoGraphDAO(new \Interactor\MySqlQueryEngine());
                $PhotographDAO->insert($Photograph);
                echo "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.";
                redirect_to('http://localhost/photo_gallery/index.html#/view4');
            } else {
               echo "Sorry, there was an error uploading your file.";
                redirect_to('http://localhost/photo_gallery/index.html#/view4');

            }
        }
?>