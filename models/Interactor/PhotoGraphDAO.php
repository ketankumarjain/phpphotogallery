<?php
/**
 * Created by PhpStorm.
 * User: ketan
 * Date: 5/11/2015
 * Time: 11:26 AM
 */

namespace Interactor;

use entity\Photograph;
require_once dirname(__DIR__)."/../config/Auto_load.php";


class PhotoGraphDAO extends DAO {

    const PHOTOGRAPHSTABLE = "photographs";

    public function __construct(DBGetway $db){
        $this->db=$db;
        $this->table_name= self::PHOTOGRAPHSTABLE;
    }

    public  function destroy($photograph) {            //code smell here....
        if($this->remove($photograph)) {
            $String= dirname(__DIR__);
            $dir=explode("\\",$String);
            $root_Dir= $dir[0].DIRECTORY_SEPARATOR.$dir[1].DIRECTORY_SEPARATOR.$dir[2].DIRECTORY_SEPARATOR.$dir[3];
            $target_path = $root_Dir."/".$photograph->path;
            if(unlink($target_path)) {
                true;
            }
        } else {
            return false;
        }
    }

    public   function save($Photograph) {
        if($Photograph->getId()) {
            $this->update($Photograph);
        } else {
                $this->Insert($Photograph);
        }
    }
    public  function getPhotographs(){
        $all=$this->getAll();
        $photographs=array();
        for($index=0;$index<count($all);$index++){
            $std=$all[$index];
            $photograph=new Photograph();
            $photograph->setId($std->id);
            $photograph->setFilename($std->filename);
            $photograph->setPath($std->path);
            $photograph->setSize($std->size);
            $photograph->setType($std->type);
            $photograph->setCaption($std->caption);
            $photographs[$index]=$photograph;
        }
            return $photographs;
    }
    public  function getComments($Photograph){
       $Comment=new CommentsDAO($this->db);
        return  $Comment->getComments_by($Photograph->id);
    }

}
