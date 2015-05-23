<?php
/**
 * Created by PhpStorm.
 * User: ketan
 * Date: 5/11/2015
 * Time: 11:26 AM
 */

namespace Interactor;

use entity\Photograph;

include_once"D:/wamp/www/phpphotogallery/config/UploadErrors.php";
include_once"D:/wamp/www/phpphotogallery/models/entity/Photograph.php";
include_once"D:/wamp/www/phpphotogallery/models/Interactor/DAO.php";
include_once"D:/wamp/www/phpphotogallery/models/Interactor/db/MySqlQueryEngine.php";
include_once "D:/wamp/www/phpphotogallery/models/Interactor/CommentsDAO.php";



class PhotoGraphDAO extends DAO {

    public $errors=array();
    public function __construct(DBGetway $db){
        $this->db=$db;
        $this->table_name="photographs";
    }

    public  function destroy($photograph) {
        // First remove the database entry
        if(self::remove($photograph)) {

            // then remove the file
            // Note that even though the database entry is gone, this object
            // is still around (which lets us use $this->image_path()).
            $target_path = "D:/wamp/www/phpphotogallery/".$photograph->path;
            return unlink($target_path) ? true : false;
        } else {
            // database delete failed
            return false;
        }
    }

    public   function save($Photograph) {
        // A new record won't have an id yet.

        if($Photograph->getId()) {
            // Really just to update the caption
            $this->update($Photograph);
        } else {

                $this->Insert($Photograph);
        }
    }

    public  function getPhotographs(){
        $all=$this->getAll();
        $len=count($all);
        $photograpList=array();
        for($index=0;$index<$len;$index++){
            $std=$all[$index];
            $photograp=new Photograph();
            $photograp->setId($std->id);
            $photograp->setFilename($std->filename);
            $photograp->setPath($std->path);
            $photograp->setSize($std->size);
            $photograp->setType($std->type);
            $photograp->setCaption($std->caption);
            $photograpList[$index]=$photograp;
        }
            return $photograpList;
    }
    public  function getComments($Photograph){
       $Comment=new CommentsDAO($this->db);
        return  $Comment->get_all_comments_by($Photograph->id);
    }

}


?>