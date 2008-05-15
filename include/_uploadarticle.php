<?
/**
 *File saving logic
 *
 *
 */

require_once("init.inc.php");

$logger->info("uploading called");

@mkdir($config['upload_dir']);

var_dump($_FILE);

$result = array();
 
if (isset($_FILES['photoupload']) )
{
  $file = $_FILES['photoupload']['tmp_name'];
  $error = false;
  $size = false;
  
  if (!is_uploaded_file($file) || ($_FILES['photoupload']['size'] > $config['max_file_size'] ) )
    {
      $error = 'Please upload only files smaller files! SIZE: ' . $config['max_file_size'] . ' Byte';
    }

#  if (!$error && !($size = @getimagesize($file) ) )
  #    {
  #      $error = 'Please upload only images, no other files are supported.';
 #    }
 
#  if (!$error && !in_array($size[2], array(1, 2, 3, 7, 8) ) )
 #    {
  #      $error = 'Please upload only images of type JPEG.';
 #    }
 
#  if (!$error && ($size[0] < 25) || ($size[1] < 25))
 #    {
  #      $error = 'Please upload an image bigger than 25px.';
 #    }
 #  
   
 $sha1 =  sha1_file( $file );

 $logger->info("Filename: " .  $_FILES['photoupload']['name']);
 $name =  $_FILES['photoupload']['name'] ;
 
 $uploadfile = $config['upload_dir'] . '/' .  $sha1 . '_' .$name;

 $logger->info("upload processing: " . $uploadfile  . " ::  $file ");

 if( ! move_uploaded_file($file , $uploadfile) )
   $error = "Konnte die Datei nicht bearbeiten";
 
       
 if ($error)
   {
     $result['result'] = 'failed';
     $result['error'] = $error;
     $logger->err($uploadfile . " upload was not successfull");
   }
 else
   {
     $result['result'] = 'success';
     $result['size'] = "Upload war erfolgreich.";
   }
 
 }
 else
   {
     $result['result'] = 'error';
     $result['error'] = 'Missing file or internal error!';
     $logger->err($uploadfile . " upload was not successfull");
   }

if (!headers_sent() )
  {
    header('Content-type: application/json');
  }

echo json_encode($result);
?>