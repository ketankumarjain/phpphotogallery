<?php
/**
 * Created by PhpStorm.
 * User: ketan
 * Date: 4/26/2015
 * Time: 1:38 PM
 */

namespace Interactor;


interface DBGetway {
    function find_by_id($idNumber,$table_name);
    function find_All($table_name);
    function countAll($table_name);
    function create($objectAss_Array,$table_name);
    function delete($object,$table_name);
    function update($object,$table_name);
    function find_user_query($sql,$table_name="");
    function find_comment_by_Photo_id($objet,$table);
    public  function removeComment_by_PhotoId($photo_id);

}