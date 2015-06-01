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

    public $errors=array();
    const PHOTOGRAPHSTABLE = "photographs";

    public function __construct(DBGetway $db){
        $this->db=$db;
        $this->table_name= self::PHOTOGRAPHSTABLE;
    }

    public  function destroy($photograph) {
        if($this->remove($photograph)) {
            //code smell
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
        return  $Comment->getComments_by($Photograph->id);
    }

}
