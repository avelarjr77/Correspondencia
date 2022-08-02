<?php

function upload() {$preview = $config = $errors = [];}

$outData = upload(); // a function to upload the bootstrap-fileinput files
echo json_encode($outData); // return json data
exit();
        
$archivo=$_FILES["fileUpload"]['tmp_name'];
$nombreArchivo=$archivo;
$directorio = "uploads/".$nombreArchivo;

if (move_uploaded_file($_FILES['fileUpload']['tmp_name'], $directorio)) {
    echo "File is valid, and was successfully uploaded.\n";
} else {
    echo "Possible file upload attack!\n";
}
echo $uploadfile;

?>