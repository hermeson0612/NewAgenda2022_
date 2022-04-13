<!DOCTYPE html>
<html lang="pt_br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Agenda JMF | Registro</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a href="../../index2.html"><b>Agenda</b>JMF</a>
  </div>

  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg">Registro de novo usuário</p>

      <form action="" method="post" enctype="multipart/form-data">
        <div class="input-group mb-3">
          <input name="nome" type="text" class="form-control" placeholder="Nome...">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input name="email" type="email" class="form-control" placeholder="E-mail...">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input name="senha" type="password" class="form-control" placeholder="Senha">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="form-group">  
          <div class="input-group">
            <div class="custom-file">
              <input name="foto" type="file" class="custom-file-input" id="exampleInputFile">
              <label class="custom-file-label" for="exampleInputFile">Add foto do usuário</label>
            </div>
            
          </div>
        </div>
        <div class="row">
          
          <!-- /.col -->
          <div class="col-6">
            <button style="margin: 0 0 20px 0;" type="submit" name="btnCContato" class="btn btn-primary btn-block">Registrar</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <?php
                  include_once('config/conexao.php');
                  if(isset($_POST['btnCContato'])){
                      $nome = $_POST['nome'];
                      $senha = $_POST['senha'];
                      $email = $_POST['email'];
                      $formatP = array("png","jpg","jpeg","JPG","gif");
                      $extensao = pathinfo($_FILES['foto'][
                        'name'], PATHINFO_EXTENSION);

                      if(in_array($extensao, $formatP)){
                          $pasta = "img/batata/";
                          $temporario = $_FILES['foto']['tmp_name'];
                            $novoNome = uniqid().".$extensao";

                            if(move_uploaded_file($temporario, $pasta.$novoNome)){
                              $cadastro = "INSERT INTO Tb_batata (nome_batata, email_batata, senha_batata, foto_batata) VALUES (:nome, :email, :senha, :foto)";
                              try{
                                $result = $conect->prepare($cadastro);
                                $result->bindParam(':nome',$nome,PDO::PARAM_STR);
                                $result->bindParam(':senha',$email,PDO::PARAM_STR);
                                $result->bindParam(':email',$senha,PDO::PARAM_STR);
                                $result->bindParam(':foto',$novoNome,PDO::PARAM_STR);
                                $result->execute();
        
                                $contar = $result->rowCount();
                                if($contar > 0){
                                  echo '<div class="container">
                                            <div class="alert alert-success alert-dismissible">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            <h5><i class="icon fas fa-check"></i> OK!</h5>
                                            Contato inserido com sucesso !!!
                                          </div>
                                        </div>';
                                }else{
                                  echo '<div class="container">
                                            <div class="alert alert-danger alert-dismissible">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            <h5><i class="icon fas fa-check"></i> Ops!</h5>
                                            Contato não cadastrados !!!
                                          </div>
                                        </div>';
                                }
                              }catch(PDOException $e){
                                echo "<strong>ERRO DE CADASTRO PDO = </strong>".$e->getMessage();
                              }
                            
                            }else{
                              echo "Erro, não foi possível fazer o upload do arquivo!";
                            }
                          

                  }else{
                    echo "Formato Inválido";
                  }
                                          
                    
                    }
              ?>
      <a href="index.php" class="text-center">Ir para o login!</a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>
