<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sistema de gestão de locação para imobiliárias</title>
    <link href="../../public/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../public/css/index.css" rel="stylesheet">
  </head>
  <body class="text-center">
    <div class="cover-container d-flex h-100 w-100 p-3 mx-auto flex-column">
      <header class="masthead mb-auto">
        <div class="inner">
          <h3 class="masthead-brand">Vista</h3>
          <nav class="nav nav-masthead justify-content-center">
            <a class="nav-link" href="../../index.php">Home</a>
            <a class="nav-link active" href="../cliente/cadastrar.php">Cadastrar cliente</a>
            <a class="nav-link" href="../proprietario/cadastrar.php">Cadastrar proprietário</a>
          </nav>
        </div>
      </header>

      <main role="main" class="inner cover" style="margin-left:20%">
        <form class="form-signin" method="POST" action="../../controllers/cliente/clienteController.php" style="max-width:330px">
            <h1 class="h3 mb-3 font-weight-normal">Cadastrar cliente</h1>
            <input type="text" name="name" class="form-control my-2" placeholder="Nome" required>
            <input type="email" name="email" class="form-control my-2" placeholder="E-mail" required>
            <input type="telephone" name="telephone" class="form-control my-2" placeholder="Telefone" required>
            <button class="btn btn-lg btn-primary btn-block" style="background-color:#55b5a6; border-color:#55b5a6;" type="submit">Cadastrar</button>
        </form>
      </main>
      <footer class="mastfoot mt-auto">
        <div class="inner">
          <p>Vista @2022</p>
        </div>
      </footer>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  </body>
</html>
