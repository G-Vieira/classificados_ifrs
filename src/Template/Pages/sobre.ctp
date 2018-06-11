<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sobre</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/round-about.css" rel="stylesheet">

  </head>
  <style type="text/css">
   h1{
    font-weight: bold;
   } 

   #p1{
    font-size: 20px;
   }

   h2{
    font-weight: bold;
   }
  </style>



  <body>

    <!-- Navigation -->
    

    <!-- Page Content -->
    <div class="container">

      <!-- Introduction Row -->
      <h1 align="center" class="my-4">Sobre nÃ³s
      </h1>
      <p id="p1" align="center">Somos alunos do Instituto Federal 
    do Rio Grande do Sul. Trabalhamos com o intuito de 
    desenvolver aplicaÃ§Ãµes sob demanda das necessidades dos alunos e servidores da instituiÃ§Ã£o.</p>


      <!-- Team Members Row -->
      <br>
      <div class="row">
        <div class="col-lg-12">
          <h2 align="center" class="my-4">Nosso Time</h2>
          <br>
        </div>

        <div class="col-lg-4 col-sm-6 text-center mb-4">
          <?php echo $this->Html->image('matheus_neu.jpg')?>
          <br>
      <h3>Matheus Neu
            <small><br>Programador na empresa </small>
          </h3>
          <p>6Âº Semestre CiÃªncia da ComputaÃ§Ã£o</p>
        </div>
        <div class="col-lg-4 col-sm-6 text-center mb-4">
          <?php echo $this->Html->image('ewerton_hoffmann.jpg')?>
          <br>
      <h3>Ewerton Hoffmann
            <small><br>EscriturÃ¡rio na empresa Banrisul S.A</small>
          </h3>
          <p>6Âº Semestre CiÃªncia da ComputaÃ§Ã£o</p>
        </div>
        <div class="col-lg-4 col-sm-6 text-center mb-4">
          <?php echo $this->Html->image('gian_paulo.jpg')?>
          <br>
      <h3>Gian Paulo Vieira
            <small><br>Programador na empresa CotribÃ¡</small>
          </h3>
          <p>6Âº Semestre CiÃªncia da ComputaÃ§Ã£o</p>
        </div>
      </div>
    </div>
    <!-- /.container -->

    <!-- Footer -->
    <br><br>
    <footer class="py-5 bg-dark">
      
      <div align="center">
        <?php echo $this->Html->image('ifrs.jpg')?>
      </div>
      <div class="container">
        <p class="m-0 text-center text-white">Intituto Federal do Rio Grande do Sul<br> Campus IbirubÃ¡</p>
      </div>
      
      <!-- /.container -->
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>

</html>
