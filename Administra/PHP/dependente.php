<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Administra</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

  <!-- Ícones Bootstrap -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />

  <!-- CSS personalizado -->
  <link href="principal.css" rel="stylesheet" />
</head>
<body style="padding-top: 80px;">

  <!-- HEADER -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top shadow">
  <div class="container">
    <a class="navbar-brand fw-bold" href="index.html">Administra</a> <!-- Link para página principal -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link" href="../HTML/login.html">Login</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="dependentes.php">Cadastro Dependentes</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="despesa.php">Despesas</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="tela_dividas.html">Dívidas</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="tela_renda.html">Renda</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

  <!-- CADASTRO DEPENDENTES -->
  <main class="container mt-4">
    <div class="row justify-content-center">
      <!-- FORMULÁRIO DE CADASTRO -->
      <div class="col-md-6 mb-4">
        <div class="form-section bg-white p-4 rounded shadow-sm h-100">
          <h3 class="text-center">Cadastrar Dependentes</h3>
          
          <form class="formGasto" action="cadastraDependente.php" method="post">
          <label for="nomeDependente" class="mt-3">Nome do dependente:</label>
            <input name = "txtnome" type="text" id="nomeDependente" class="form-control" placeholder="Digite o nome do dependente..." required />
  
            <label for="relacao" class="mt-3">Relação:</label>
            <input name = "txtrelacao" type="text" id="relacao" class="form-control" placeholder="Ex: Filho(a), Pai/Mãe..." required />
  
            <button type="submit" class="btn btn-success mt-4">Cadastrar dependente</button>
          </form>
        </div>
      </div>
      <div class="col-md-6 mb-4">
        <div class="form-section bg-white p-4 rounded shadow-sm h-100">
          <h3 class="text-center">Dependentes Cadastrados</h3>
          <ul id="listaDependentes" class="list-group mt-3">

<?php
session_start();
include 'conexao.php';

	$id = $_SESSION['ID_USER'];

    $select = "select * from dependente where fk_usuario = $id";
    $dependente = mysqli_query($conn, $select);

    while($pegaDependente = mysqli_fetch_assoc($dependente)){

        $nomeDependente = $pegaDependente['nome_dependente'];
        $relacaoDependente = $pegaDependente['relacao'];
    
    echo"
        <li class='list-group-item' style = 'text-align: center;' >$nomeDependente - $relacaoDependente
        <img src='https://cdn-icons-png.flaticon.com/512/1214/1214428.png' 
            alt='Excluir' 
            class='icon-excluir' 
            style='cursor:pointer; width:24px; height:24px;' 
            onclick='confirmarExclusao(this)'>
        </li>
    ";
    }
?>
    </ul>
        </div>
      </div>
    </div>
  </main>

  <script>
    function confirmarExclusao(elemento) {
      if (confirm("Tem certeza que deseja excluir este dependente?")) {
        const itemLista = elemento.closest("li");
        itemLista.remove();
      }
    }
  </script>
  
   <!-- Bootstrap JS -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- FOOTER -->
<footer class="mt-4">
  <div class="container text-center">
    <p class="mb-1">© 2025 Administra - Todos os direitos reservados</p>
  </div>
</footer>

</body>
</html>