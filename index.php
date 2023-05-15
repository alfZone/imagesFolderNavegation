<?php
  
/**
 * The objective of the repository is to provide HTML, PHP, and JavaScript code to manage a folder where images are stored..
 * @author António Lira Fernandes
 * @version 5.2
 * @updated 301-03-2023 21:50:00
 * https://github.com/alfZone/imagesFolderNavegation
 */

//require __DIR__ . '/../config.php';
//require __DIR__ . '/../bootstrap.php';

  use classes\string\Strings;  

  //Text string and definitions

  //$URL_BASE="/images";
  $URL_BASE="<Path in the website's URL>"; 
  // to see complete path use getcwd
  //echo getcwd();
  //$DIR_BASE="/home/esmonser/justicaepazviana.pt/images";
  $DIR_BASE="<Full path to the folder in the file system>";
  //$text=array("Imagens", "Gerir as Imagens", "Carregar Imagens", "Procurar", "Imagens na pasta: ", "Zona de upload", "Entrar", "Voltar");
  $text=array("Images", "Manager Images", "Load Images", "Search", "Images on folder: ", "Upload zone", "Go", "Go back");
  
    
  $st=new Strings();
  $actual_link = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
  
  $actual_link=$st->after($URL_BASE, $actual_link);
  $actual_link=str_replace("//", "/", $actual_link);
  //echo $actual_link;

 
  //$dir = '/'; //insira aqui o caminho para a pasta que deseja visualizar
  //$dirbase="/home/uroybek/www/imagens";
  //$urlbase="/imagens";
  $dir=$DIR_BASE . $actual_link;
  //echo $dir . "<br>";
  //$dir=$DIR_BASE; 
  $url=$URL_BASE . $actual_link;
  //echo $url;

  $files = scandir($dir);

  $dirs = array();
  $other_files = array();

  foreach ($files as $file) {
      if ($file == '.' || $file == '..') {
          continue;
      }

      if (is_dir($DIR_BASE . '/' . $file)) {
          $dirs[] = $file;
      } else {
          $other_files[] = $file;
      }
  }

  sort($dirs);
  sort($other_files);

  $files = array_merge($dirs, $other_files);

?>

<!DOCTYPE html>
<html lang="pt">
<head>
  <title><?=$text[0]?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
   <link href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-sm navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="/public/<?=$URL_BASE?>"><?=$text[1]?></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="mynavbar">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link" href="javascript:void(0)"><?=$text[2]?></a>
        </li>
      </ul>
      <form class="d-flex">
        <input class="form-control me-2" id="search" type="text" placeholder="Search" onkeyup="FilterImage()" >
        <button class="btn btn-primary" type="button" onclick="FilterImage()"><?=$text[3]?></button>
      </form>
    </div>
  </div>
</nav>

<div class="container mt-3">
  <h2><?=$text[4]?> <?=$url?></h2>
  <div class="row" id="listFiles">
    <div class="col-sm-3 p-3 bg-dark">
      <div class="card" style="width:250px">
        <div class="card-body">
          <h4><?=$text[5]?></h4> 
          <form action="<?=$URL_BASE?>/upload.php" class="dropzone">   
            <input type="hidden" name="pathinfo" value=".<?=$actual_link?>"/>
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
                      <h4><?=$text[7]?></h4>
                    </div>
                    <div class="card-footer">
                      <a href="/public<?=$URL_BASE."/".$aux?>" class="btn btn-primary">
                        <?//=$text[6]?>
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0v2z"/>
                        <path fill-rule="evenodd" d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z"/>
                      </svg>
                    </a>
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
                      <h4><?=$file?></h4> 
                    </div>
                    <div class="card-footer">
                      <a href="/public<?=$url."/".$file?>" class="btn btn-primary">
                        <?//=$text[6]?>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-folder2-open" viewBox="0 0 16 16">
                          <path d="M1 3.5A1.5 1.5 0 0 1 2.5 2h2.764c.958 0 1.76.56 2.311 1.184C7.985 3.648 8.48 4 9 4h4.5A1.5 1.5 0 0 1 15 5.5v.64c.57.265.94.876.856 1.546l-.64 5.124A2.5 2.5 0 0 1 12.733 15H3.266a2.5 2.5 0 0 1-2.481-2.19l-.64-5.124A1.5 1.5 0 0 1 1 6.14V3.5zM2 6h12v-.5a.5.5 0 0 0-.5-.5H9c-.964 0-1.71-.629-2.174-1.154C6.374 3.334 5.82 3 5.264 3H2.5a.5.5 0 0 0-.5.5V6zm-.367 1a.5.5 0 0 0-.496.562l.64 5.124A1.5 1.5 0 0 0 3.266 14h9.468a1.5 1.5 0 0 0 1.489-1.314l.64-5.124A.5.5 0 0 0 14.367 7H1.633z"/>
                        </svg>
                      </a>
                    </div>
                  </div>
                </div>
                  <?php
            }
            else {
              // Images
                $ext = pathinfo($file, PATHINFO_EXTENSION);
                if(in_array($ext, array('jpg', 'jpeg', 'png', 'gif', 'wepb'))) {
                    //echo '<p>Imagem: '.$file.'</p>';
                    //echo '<img src="'.$file.'" alt="'.$file.'" width="100%" height="100%">';
                  ?>
                <div class="col-sm-3 p-3">
                  <div class="card" style="width:250px">
                    <img class="card-img-top" src="<?=$url."/".$file?>" alt="<?=$file?>" style="width:100%" id="<?=$file?>">
                    <div class="card-body">
                      <h4><?=$file?></h4> 
                    </div>
                    <div class="card-footer">
                      <button id="copy-button"  class="btn btn-primary" onclick="copyURL('<?=$file?>')">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clipboard-check" viewBox="0 0 16 16">
                          <path fill-rule="evenodd" d="M10.854 7.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
                          <path d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z"/>
                          <path d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3z"/>
                        </svg>
                      </button>
                      <button id="copy-button"  class="btn btn-primary" onclick="Download('<?=$url."/".$file?>')">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                          <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                          <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
                        </svg>
                      </button>
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
    //console.log("aqui")
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
        //console.log("err: " + response )
        // Ocorreu um erro ao carregar o arquivo!
      }
    };
    
       
    function copyURL(id) {
      // Seleciona a URL da imagem
      var photoUrl = document.getElementById(id).src;
      // Cria um elemento de texto temporário para armazenar a URL da imagem
      var tempInput = document.createElement("input");
      tempInput.value = photoUrl;
      // Adiciona o elemento de texto temporário ao DOM
      document.body.appendChild(tempInput);
      // Seleciona o texto no elemento de texto temporário
      tempInput.select();
      // Copia o texto selecionado para a área de transferência
      document.execCommand("copy");
      // Remove o elemento de texto temporário do DOM
      document.body.removeChild(tempInput);
      // Exibe uma mensagem informando que a URL da foto foi copiada com sucesso
      //alert("URL da foto copiada com sucesso!");
    }
        
    function FilterImage() {
      var input, filter, img, cards, a, i, txtValue;
      input = document.getElementById("search");
      filter = input.value.toUpperCase();
      //console.log(filter);
      img = document.getElementById("listFiles");
      cards = img.getElementsByClassName("col-sm-3");
      //console.log(cards);
      for (i = 0; i < cards.length; i++) {
          a = cards[i].getElementsByTagName("h4")[0];
        console.log(cards[i]);
          txtValue = a.textContent || a.innerText;
          if (txtValue.toUpperCase().indexOf(filter) > -1) {
              cards[i].style.display = "";
          } else {
              cards[i].style.display = "none";
          }
      }
    } 
                                             
  function Download(url) {
        // código para baixar a imagem

      fetch(url)
      .then(response => response.blob())
      .then(blob => {
        const url = URL.createObjectURL(blob);
        const a = document.createElement("a");
        a.href = url;
        a.download = "imagem.jpg";
        document.body.appendChild(a);
        a.click();
        a.remove();
        URL.revokeObjectURL(url);
      });
     
   }
                                               
  </script>
</body>
</html> 
