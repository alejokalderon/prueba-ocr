<!DOCTYPE html>
<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>TRABAJO PR&Aacute;CTICO</title>
<style>
<!--
 p.MsoNormal
        {mso-style-parent:"";
        margin-bottom:.0001pt;
        font-size:10.0pt;
        font-family:"Times New Roman","serif";
        margin-left:0cm; margin-right:0cm; margin-top:0cm}
-->
</style>
</head>

<body>

<p class="MsoNormal" align="center" style="text-align: center">
<img border="0" src="logo.jpg" width="316" height="100"></p>
<p class="MsoNormal" align="center" style="text-align: center"><b>
<span lang="ES-CO" style="font-size:12.0pt">TRABAJO PR&Aacute;CTICO</span></b></p>
<p class="MsoNormal" align="center" style="text-align: center"><b>
<span lang="ES-CO" style="font-size:12.0pt">&nbsp;</span></b></p>
<p class="MsoNormal" align="center" style="text-align: center"><b>
<span lang="ES-CO" style="font-size:12.0pt">SISTEMA OCR PARA INTERPRETAR
IM&Aacute;GENES</span></b></p>
<p class="MsoNormal" align="center" style="text-align: center">
<span lang="ES-CO" style="font-size: 12.0pt">&nbsp;</span></p>
<p class="MsoNormal" align="center" style="text-align: center"><b>
<span lang="ES-CO" style="font-size:12.0pt">Estudiantes:<br>
<br>
Yeison Alejandro Calder&oacute;n Zapata</span></b></p>
<p class="MsoNormal" align="center" style="text-align: center"><b>
<span lang="ES-CO" style="font-size:12.0pt">Edwin Andr&eacute;s Gil Fern&aacute;ndez</span></b></p>
<p class="MsoNormal" align="center" style="text-align: center"><b>
<span lang="ES-CO" style="font-size:12.0pt">Cristian Arbey Jaramillo Posada<br>
<br>
</span></b><span lang="ES-CO" style="font-size: 12.0pt">&nbsp;</span></p>
<p class="MsoNormal" align="center" style="text-align: center"><b>
<span lang="ES-CO" style="font-size:12.0pt">Docente:<br>
&nbsp;</span></b></p>
<p class="MsoNormal" align="center" style="text-align: center"><b>
<span lang="ES-CO" style="font-size:12.0pt">ALEXANDER DE JESUS NARVAEZ BERRIO<br>
</span></b><span lang="ES-CO" style="font-size: 12.0pt">&nbsp;</span></p>
<p class="MsoNormal" align="center" style="text-align: center"><b>
<span lang="ES-CO" style="font-size:12.0pt">CAT&Oacute;LICA DEL NORTE FUNDACI&Oacute;N
UNIVERSITARIA<br>
MEDELL&Iacute;N - ANTIOQUIA<br>
2019 </span></b></p>
  <form enctype="multipart/form-data" action="upload.php" method="POST">
    <p align="center">Cargar archivo de imagen</p>
    <p align="center">
    <input type="file" name="uploaded_file"></input></p>
        <p align="center"><br />
    <input type="submit" value="Transformar"></input>
  </p>
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
      " Archivo de imagen transformado satisfactoriamente a texto:";
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
