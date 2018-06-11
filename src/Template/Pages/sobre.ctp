
<?= $this->Html->css('sobre.css'); ?>
    <!-- Navigation -->
    <!-- Page Content -->
    <div class="container">

      <!-- Introduction Row -->
      <h1 align="center" class="my-4">Sobre nós
      </h1>
      <p id="p1" align="center">Somos alunos do Instituto Federal 
    do Rio Grande do Sul. Trabalhamos com o intuito de 
    desenvolver aplicações sob demanda das necessidades dos alunos e servidores da instituição.</p>


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
            <small><br>Programador na empresa Ceprotec </small>
          </h3>
          <p>6º Semestre Ciência da Computação</p>
        </div>
        <div class="col-lg-4 col-sm-6 text-center mb-4">
          <?php echo $this->Html->image('ewerton_hoffmann.jpg')?>
          <br>
      <h3>Ewerton Hoffmann
            <small><br>Escriturário na empresa Banrisul S.A</small>
          </h3>
          <p>6º Semestre Ciência da Computação</p>
        </div>
        <div class="col-lg-4 col-sm-6 text-center mb-4">
          <?php echo $this->Html->image('gian_paulo.jpg')?>
          <br>
      <h3>Gian Paulo Vieira
            <small><br>Programador na empresa Cotribá</small>
          </h3>
          <p>6º Semestre Ciência da Computação</p>
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
        <p class="m-0 text-center text-white">Intituto Federal do Rio Grande do Sul<br> Campus Ibirubá</p>
      </div>
      
      <!-- /.container -->
    </footer>
