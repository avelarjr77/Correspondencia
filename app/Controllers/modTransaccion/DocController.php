<?php namespace App\Controllers\modTransaccion;

use App\Controllers\BaseController;
use App\Models\modTransaccion\TransaccionActividadModel;
use App\Models\modTransaccion\TransaccionConfigModel;

//defined('BASEPATH') OR exit('No direct script access allowed');

class DocController extends BaseController{

    public function _constructor(){
        parent::_constructor();
        $this->load->helper('url');
    }

    public function doc(){

       
        if(!empty($_FILES['file']['name'])){
      /*       
            // Set preference
            $config['upload_path'] = './uploads/'; 
            $config['allowed_types'] = 'jpg|jpeg|png|gif|docx';
            $config['max_size'] = '1024'; // max_size in kb
            $config['file_name'] = $_FILES['file']['name'];

            //Load upload library
            $this->load->library('upload',$config); 

            // File upload
            if($this->upload->do_upload('file')){
            // Get data about the file
            $uploadData = $this->upload->data();
            }
        } 
*/
        $uploaddir = './uploads/';
        $uploadfile = $uploaddir . basename($_FILES['file']['name']);

        if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
            echo "File is valid, and was successfully uploaded.\n";
        } else {
            echo "Possible file upload attack!\n";
        }

        echo $uploadfile;
    }
}
}

?>
