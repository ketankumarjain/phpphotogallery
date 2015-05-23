<?php
/**
 * Created by PhpStorm.
 * User: ketan
 * Date: 5/11/2015
 * Time: 3:09 PM
 */

namespace config;


class UploadErrors {
    public static $upload_errors = array(
        // http://www.php.net/manual/en/features.file-uploadedimage.errors.php
        UPLOAD_ERR_OK 				=> "No errors.",
        UPLOAD_ERR_INI_SIZE  	=> "Larger than upload_max_filesize.",
        UPLOAD_ERR_FORM_SIZE 	=> "Larger than form MAX_FILE_SIZE.",
        UPLOAD_ERR_PARTIAL 		=> "Partial uploadedimage.",
        UPLOAD_ERR_NO_FILE 		=> "No file.",
        UPLOAD_ERR_NO_TMP_DIR => "No temporary directory.",
        UPLOAD_ERR_CANT_WRITE => "Can't write to disk.",
        UPLOAD_ERR_EXTENSION 	=> "File uploadedimage stopped by extension."
    );
}