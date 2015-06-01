<?php
/**
 * Created by PhpStorm.
 * User: ketan
 * Date: 4/26/2015
 * Time: 1:38 PM
 */

namespace Interactor;


interface DBGetway {

    function find_All($table_name);
    function create($associativeArray,$table_name);
    function delete($associativeArray,$table_name);
    function update($associativeArray,$table_name);
    function findBySingleValue($key,$value,$table_name);
    public function find_by_Values($key1,$value1,$key2,$value2,$table_name);
    public function removeBySingleValue($key,$value,$table_name);

}