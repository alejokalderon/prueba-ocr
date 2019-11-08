<!DOCTYPE html>
<html>
<head>
  <title>OCR</title>
</head>
<body>
  <form enctype="multipart/form-data" action="upload.php" method="POST">
    <p>Sube tu archivo</p>
    <input type="file" name="uploaded_file"></input><br />
    <input type="submit" value="Subir"></input>
  </form>
</body>
</html>
<?PHP
  if(!empty($_FILES['uploaded_file']))
  {
    $path = "uploads/";
    $path = $path . basename( $_FILES['uploaded_file']['name']);
    if(move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $path)) {
      echo "El archivo ".  basename( $_FILES['uploaded_file']['name']).
      " ha sido subido satisfactoriamente.";
      $output = exec("/usr/local/bin/tesseract ./uploads/".basename( $_FILES['uploaded_file']['name'])." ./out -l eng");
      $fp = fopen("./out.txt", r);
      echo "<br /><br />";
      while(!feof($fp)) {
        $linea = fgets($fp);
        echo $linea . "<br />";
      }
      fclose($fp);
      $output = exec("rm -rf ./uploads/*");
      $output = exec("rm -rf ./out.txt");
    } else{
        echo "¡Ha ocurrido un error subiendo el archivo, por favor intentalo de nuevo!";
    }
  }
?>
