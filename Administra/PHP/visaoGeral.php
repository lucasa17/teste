  <?php
session_start();
include 'conexao.php';

  if(empty($_SESSION['ID_USER'])){

    echo"	
        <div id='loadingOverlay'>
            <div id='loadingCard'>
            <h1>Administra</h1>
            <img src='https://cdn.dribbble.com/users/2469324/screenshots/6538803/comp_3.gif' alt='Carregando...' />
            <strong><p class='mt-3'>Usuário não esta logado</p></strong>
            </div>
        </div>
        ";        
    header("refresh: 3.5; url=../index.html");
  }
  
?>
  
  <!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Administra - Visão Geral</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

  <!-- Ícones Bootstrap -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />

  <!-- CSS personalizado -->
  <link href="../CSS/principal.css" rel="stylesheet" />

  <!-- Chart.js -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body style="padding-top: 80px;">
  <!-- HEADER -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top shadow">
    <div class="container">
      <a class="navbar-brand fw-bold" href="index.html">Administra</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
        <li class="nav-item">
            <a class="nav-link" href="visaoGeral.php">Visão Geral</a>
        </li>
       <li class="nav-item">
            <a class="nav-link" href="despesa.php">Despesas</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="divida.php">Dívidas</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="renda.php">Renda</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="meta.php">Metas</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="dependente.php">Dependentes</a>
        </li>
            <form action='sair.php' method='POST' style='display:inline;'>
            <button type='submit' class='btn btn-danger btn-sm' Style='Background-color:Red; Border-radius: 20%'>Sair</button>
          </form>        
        </li>
        </ul>
      </div>
    </div>
  </nav>
<?php
	$id = $_SESSION['ID_USER'];

?>
<!-- VISÃO GERAL -->
 <!-- grafico de analise mensal-->
  <div class="container mt-5 d-flex justify-content-around flex-wrap gap-4">
    <div class="form-section bg-white p-4 rounded shadow-sm" style="max-width: 600px; height: 450px;">
      <h3 class="mb-4 text-center">Análise Mensal</h3>
      <canvas id="graficoMensal" style="width: 100%; max-height: 350px;"></canvas>
    </div>

<!-- grafico de analise anual-->
    <div class="form-section bg-white p-4 rounded shadow-sm" style="max-width: 600px; height: 450px;">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">Análise Anual</h3>
        <select id="anoSelect" class="form-select w-auto">
          <option value="2025" selected>2025</option>
          <option value="2024">2024</option>
          <option value="2023">2023</option>
        </select>
      </div>
      <canvas id="graficoAnual" style="width: 100%; max-height: 350px;"></canvas>
    </div>
  </div>  

<!-- Mensagem de saldo positivo -->
<div class="container">
  <div id="saldoPositivoAlert" class="alert alert-success d-flex justify-content-between align-items-center mt-3" style="display: none;">
    <div>
      <i class="bi bi-cash-stack me-2"></i>
      <strong>Parabéns!</strong> Você teve um saldo positivo de <span id="saldoValor">R$ 0,00</span> este mês. Deseja adicionar esse valor às suas metas?
    </div>
    <div>
      <button id="btnSim" class="btn btn-success btn-sm me-2">Sim</button>
      <button id="btnNao" class="btn btn-outline-secondary btn-sm">Não</button>
    </div>
  </div>
</div>

 <!-- RENDA - TABELA E GRÁFICO -->
  <div class="container mt-5"> 
    <div class="row">
      <!-- TABELA DE RENDA -->
      <div class="col-md-6">
        <div class="form-section bg-white p-4 rounded shadow-sm">
          <h4 class="mb-3 text-center">Rendas Cadastradas</h4>
          <div class="table-responsive">
            <table class="table table-bordered align-middle">
              <thead class="table-light">
                <tr>
                  <th>Data</th>
                  <th>Tipo</th>
                  <th>Valor (R$)</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>10/06/2025</td>
                  <td>Salário</td>
                  <td>R$ 3.500,00</td>
                </tr>
                <tr>
                  <td>20/06/2025</td>
                  <td>Freelance</td>
                  <td>R$ 1.200,00</td>
                </tr>
                <tr>
                  <td>25/06/2025</td>
                  <td>Bico</td>
                  <td>R$ 500,00</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
  
      <!-- GRÁFICO DE RENDA -->
      <div class="col-md-6">
        <div class="form-section bg-white p-4 rounded shadow-sm">
          <h4 class="mb-3 text-center">Distribuição de Renda</h4>
          <canvas id="graficoRenda" style="max-width: 300px; height: auto; margin: 0 auto; display: block;"></canvas>
        </div>
      </div>
    </div>
  </div>

  <!-- DESPESAS - TABELA E GRÁFICO -->
  <div class="container mt-5">
    <div class="row">

      <!-- TABELA DE DESPESAS -->
      <div class="col-md-6">
        <div class="form-section bg-white p-4 rounded shadow-sm">
          <h4 class="mb-3 text-center">Despesas Registradas</h4>
          <div class="table-responsive">
            <table class="table table-bordered align-middle">
              <thead class="table-light">
                <tr>
                  <th>Data</th>
                  <th>Categoria</th>
                  <th>Valor (R$)</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>05/06/2025</td>
                  <td>Alimentação</td>
                  <td>R$ 600,00</td>
                </tr>
                <tr>
                  <td>12/06/2025</td>
                  <td>Transporte</td>
                  <td>R$ 200,00</td>
                </tr>
                <tr>
                  <td>25/06/2025</td>
                  <td>Educação</td>
                  <td>R$ 500,00</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
  
      <!-- GRÁFICO DE DESPESAS -->
      <div class="col-md-6">
        <div class="form-section bg-white p-4 rounded shadow-sm">
          <h4 class="mb-3 text-center">Distribuição de Despesas</h4>
          <canvas id="graficoDespesas" style="max-width: 300px; height: auto; margin: 0 auto; display: block;"></canvas>
        </div>
      </div>
    </div>
  </div>

  <!-- DÍVIDAS - TABELA E GRÁFICO -->
<div class="container mt-5">
    <div class="row">
      <div class="col-md-6">
        <div class="form-section bg-white p-4 rounded shadow-sm">
          <h4 class="mb-3 text-center">Dívidas Atuais</h4>
          <div class="table-responsive">
            <table class="table table-bordered align-middle">
              <thead class="table-light">
                <tr>
                  <th>Credor</th>
                  <th>Valor (R$)</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Cartão de Crédito</td>
                  <td>R$ 2.000,00</td>
                </tr>
                <tr>
                  <td>Empréstimo Pessoal</td>
                  <td>R$ 5.000,00</td>
                </tr>
                <tr>
                  <td>Financiamento</td>
                  <td>R$ 8.000,00</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
  
      <!-- GRÁFICO DE DÍVIDAS -->
      <div class="col-md-6">
        <div class="form-section bg-white p-4 rounded shadow-sm">
          <h4 class="mb-3 text-center">Distribuição de Dívidas</h4>
          <canvas id="graficoDividas" style="max-width: 300px; height: auto; margin: 0 auto; display: block;"></canvas>
        </div>
      </div>
    </div>
  </div>  

   <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Gráficos Chart.js -->
  <script>  
    // Gráfico Mensal
    const ctxMensal = document.getElementById('graficoMensal').getContext('2d');
    const graficoMensal = new Chart(ctxMensal, {
      type: 'bar',
      data: {
        labels: ['Renda', 'Despesas'],
        datasets: [{
          label: 'Análise de Junho 2025',
          data: [5200, 1300], 
          backgroundColor: ['rgba(75, 192, 192, 0.7)', 'rgba(255, 99, 132, 0.7)'],
          borderColor: ['rgba(75, 192, 192, 1)', 'rgba(255, 99, 132, 1)'],
          borderWidth: 1
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false, 
        scales: { 
          y: { 
            beginAtZero: true,
            ticks: {
              autoSkip: true,
              maxTicksLimit: 10 
            }
          },
          x: {
            ticks: {
                autoSkip: true,
                maxTicksLimit: 15 
            }
          }
        },
        layout: {
            padding: {
                left: 10,
                right: 10,
                top: 10,
                bottom: 10
            }
        },
        plugins: {
            legend: {
                display: true,
                position: 'top',
                labels: {
                    boxWidth: 20
                }
            }
        }
      }
    });

    // Gráfico Anual
    const ctxAnual = document.getElementById('graficoAnual').getContext('2d');
    const dadosPorAno = {
      2025: [5000, 4800, 4900, 5100, 5200, 5200, 0, 0, 0, 0, 0, 0],
      2024: [4000, 4100, 4200, 4300, 4400, 4500, 4600, 4700, 4800, 4900, 5000, 5100],
      2023: [3000, 3200, 3300, 3400, 3500, 3600, 3700, 3800, 3900, 4000, 4100, 4200]
    };

    const gastosPorAno = {
      2025: [3000, 3200, 3100, 3400, 3500, 3300, 0, 0, 0, 0, 0, 0],
      2024: [2500, 2600, 2700, 2800, 2900, 3000, 3100, 3200, 3300, 3400, 3500, 3600],
      2023: [2000, 2100, 2200, 2300, 2400, 2500, 2600, 2700, 2800, 2900, 3000, 3100]
    };

    const graficoAnual = new Chart(ctxAnual, {
  type: 'line',
  data: {
    labels: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
    datasets: [
      {
        label: 'Renda Mensal (R$)',
        data: dadosPorAno[2025],
        fill: true,
        backgroundColor: 'rgba(75, 192, 192, 0.2)',
        borderColor: 'rgba(75, 192, 192, 1)',
        tension: 0.2
      },
      {
        label: 'Gastos Mensais (R$)',
        data: gastosPorAno[2025],
        fill: true,
        backgroundColor: 'rgba(255, 99, 132, 0.2)',
        borderColor: 'rgba(255, 99, 132, 1)',
        tension: 0.2
      }
    ]
  },
  options: {
    responsive: true,
    maintainAspectRatio: false, 
    scales: { 
      y: { beginAtZero: true },
      x: {}
    },
    plugins: {
      legend: {
        display: true,
        position: 'top'
      }
    }
  }
});

document.getElementById('anoSelect').addEventListener('change', function () {
  const ano = this.value;
  graficoAnual.data.datasets[0].data = dadosPorAno[ano];
  graficoAnual.data.datasets[1].data = gastosPorAno[ano];
  graficoAnual.update();
});


    const ctxRenda = document.getElementById('graficoRenda').getContext('2d');
    new Chart(ctxRenda, {
      type: 'pie',
      data: {
        labels: ['Salário', 'Freelance', 'Bico'],
        datasets: [{
          label: 'Renda',
          data: [3500, 1200, 500],
          backgroundColor: [
            'rgba(54, 162, 235, 0.7)',
            'rgba(255, 206, 86, 0.7)',
            'rgba(75, 192, 192, 0.7)'
          ],
          borderColor: [
            'rgba(54, 162, 235, 1)',
            'rgba(255, 206, 86, 1)',
            'rgba(75, 192, 192, 1)'
          ],
          borderWidth: 1
        }]
      },
      options: {
        responsive: true,
        plugins: {
          legend: {
            position: 'bottom'
          }
        }
      }
    });

    const ctxDespesas = document.getElementById('graficoDespesas').getContext('2d');
    new Chart(ctxDespesas, {
      type: 'pie',
      data: {
        labels: ['Alimentação', 'Transporte', 'Educação'],
        datasets: [{
          data: [600, 200, 500],
          backgroundColor: [
            'rgba(255, 99, 132, 0.7)',
            'rgba(255, 159, 64, 0.7)',
            'rgba(153, 102, 255, 0.7)'
          ],
          borderColor: [
            'rgba(255, 99, 132, 1)',
            'rgba(255, 159, 64, 1)',
            'rgba(153, 102, 255, 1)'
          ],
          borderWidth: 1
        }]
      },
      options: {
        responsive: true,
        plugins: {
          legend: {
            position: 'bottom'
          }
        }
      }
    });

    const ctxDividas = document.getElementById('graficoDividas').getContext('2d');
    new Chart(ctxDividas, {
      type: 'pie',
      data: {
        labels: ['Cartão de Crédito', 'Empréstimo Pessoal', 'Financiamento'],
        datasets: [{
          data: [2000, 5000, 8000],
          backgroundColor: [
            'rgba(255, 205, 86, 0.7)',
            'rgba(201, 203, 207, 0.7)',
            'rgba(54, 162, 235, 0.7)'
          ],
          borderColor: [
            'rgba(255, 205, 86, 1)',
            'rgba(201, 203, 207, 1)',
            'rgba(54, 162, 235, 1)'
          ],
          borderWidth: 1
        }]
      },
      options: {
        responsive: true,
        plugins: {
          legend: {
            position: 'bottom'
          }
        }
      }
    });
  </script>

  <footer class="mt-4">
    <div class="container text-center">
      <p class="mb-1">© 2025 Administra - Todos os direitos reservados</p>
    </div>
  </footer>
</body>
</html>
