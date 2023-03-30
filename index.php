<?php
  
//require __DIR__ . '/../config.php';
//require __DIR__ . '/../bootstrap.php';

  use classes\string\Strings;  

    
  $st=new Strings();
  $actual_link = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
  
  $actual_link=$st->after("imagens", $actual_link);
  $actual_link=str_replace("//", "/", $actual_link);

  $dirbase="<Full path to the folder in the file system>";
  $urlbase="<Path in the website's URL>";
  $dir=$dirbase; 
  $url=$urlbase . $actual_link;
  $files = scandir($dir);

?>

<!DOCTYPE html>
<html lang="pt">
<head>
  <title>Imagens</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
   <link href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-sm navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="/public/<?=$urlbase?>">Gerir as Imagens</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="mynavbar">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link" href="javascript:void(0)">Load Images</a>
        </li>
      </ul>
      <form class="d-flex">
        <input class="form-control me-2" type="text" placeholder="Search">
        <button class="btn btn-primary" type="button">Search</button>
      </form>
    </div>
  </div>
</nav>

<div class="container mt-3">
  <h2>Imagens e pastas em <?=$url?>:</h2>
  <div class="row">
    <div class="col-sm-3 p-3 bg-dark">
      <div class="card" style="width:250px">
        <div class="card-body">
          <h3>Zona de upload</h3> 
          <form action="/imagens/upload.php" class="dropzone">   
            <input type="hidden" name="pathinfo" value="./"/>
          </form>
          
         
        </div>
      </div>
    </div>
    

<?php
      if (($actual_link!="") && ($actual_link!="/")){
        $aux=$st->before_last("/",$actual_link);
        echo $aux;
        ?>
                <div class="col-sm-3 p-3 bg-dark">
                  <div class="card" style="width:250px">
                    <div class="card-body">
                      <h4><b>Return</b></h4> 
                      <a href="/public<?=$urlbase."/".$aux?>" class="btn btn-primary">Entrar</a>
                    </div>
                  </div>
                </div>
                  <?php
      }
      foreach($files as $file) {
        if($file != '.' && $file != '..') {
            if(is_dir($dir.'/'.$file)) {
                //echo '<p><strong>Pasta: '.$file.'</strong></p>';
                ?>
                <div class="col-sm-3 p-3 bg-dark">
                  <div class="card" style="width:250px">
                    <!--img class="card-img-top" src="<?=$file?>" alt="<?=$file?>" style="width:100%"-->
                    <div class="card-body">
                      <h4><b><?=$file?></b></h4> 
                      <a href="/public<?=$url."/".$file?>" class="btn btn-primary">Entrar</a>
                    </div>
                  </div>
                </div>
                  <?php
            }
            else {
                $ext = pathinfo($file, PATHINFO_EXTENSION);
                if(in_array($ext, array('jpg', 'jpeg', 'png', 'gif'))) {
                    //echo '<p>Imagem: '.$file.'</p>';
                    //echo '<img src="'.$file.'" alt="'.$file.'" width="100%" height="100%">';
                  ?>
                <div class="col-sm-3 p-3">
                  <div class="card" style="width:250px">
                    <img class="card-img-top" src="<?=$url."/".$file?>" alt="<?=$file?>" style="width:100%">
                    <div class="card-body">
                      <h4><b><?=$file?></b></h4> 
                    </div>
                  </div>
                </div>
                  <?php
                }   
            }
        }
    }
  
?>
    </div>
  </div>
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://unpkg.com/dropzone@5.9.3/dist/dropzone.js"></script>
  <script type="text/javascript">
    console.log("aqui")
        Dropzone.options.myAwesomeDropzone = {
		autoProcessQueue: true,
		uploadMultiple: true,
		parallelUploads: 100,
		maxFiles: 100,
		acceptedFiles: ".png,.jpg,.gif,.bmp,.jpeg",
		success: function(file, response) {
			// O arquivo carregou com sucesso!
       alert(reponse);
		},
		error: function(file, response) {
      alert(reponse);
      console.log("err: " + response )
			// Ocorreu um erro ao carregar o arquivo!
		}
	};
  </script>
</body>
</html> 

