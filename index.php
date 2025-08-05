<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>On Futebol</title>

<link href="https://fonts.googleapis.com/css?family=Maven+Pro" rel="stylesheet">

<style>
  body{
      margin: 0px;
      margin-bottom: 40px;
  }
      
  a{
      color: black;
      text-decoration: none;
      padding: 20px 10px;
      border-bottom: 1px solid #dedede;
      display: block;
      font-family: 'Maven Pro', sans-serif;
  }

  g{
    font-size: 13px;
    color: #757575; 
  }

  header{
      font-size: 15px;
      background: #4CAF50;
      color: #ffffff;
      font-family: 'Maven Pro', sans-serif;
      text-align: center;
      padding: 10px;
      display: block;
      margin: 0px;
      margin-top: -5px;
   }

  iframe{
    background: #000;
    margin: 0px;
  }

  .right{
      float:right;
    }

  .navbar{
      background: #4CAF50;
      left: 0;
      top: 0;
      height: 60px;
      font-size: 20px;
      color:white;
    }
      
  .navbar-inner{
      width: 100%;
      height: 100%;
      justify-content: flex-start;
    }

  .center{
      font-size: 17px;
      font-weight: 500;
      text-align: center;
      margin: 0 2px 0 20px;
      position: relative;
      overflow: hidden;
      text-overflow: ellipsis;
      white-space: nowrap;
      line-height: 56px;
      display: inline-block;
      text-align: left;
      -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
      font-family: Roboto, Noto, Helvetica, Arial, sans-serif;
    }
      
  .iconelista{
      width: 50px;
      height: 50px;
      float: left;
      margin-right: 10px;
      margin-top: -15px;  
      border-radius: 10px;
    }      
</style>
</head>
<body>

<div class="navbar">
  <div class="navbar-inner">
    <div class="center">FutBoxOn</div>
    <div class="right">
      <a href="" style="border-bottom: 0px;padding: 0px 17px;">
        <!-- ícone refresh (SVG do seu código original) -->
        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="55px" viewBox="0 0 458.186 458.186"><g><path fill="#FFFFFF" d="M445.651,201.95c-1.485-9.308-10.235-15.649-19.543-14.164c-9.308,1.485-15.649,10.235-14.164,19.543c0.016,0.102,0.033,0.203,0.051,0.304c17.38,102.311-51.47,199.339-153.781,216.719c-102.311,17.38-199.339-51.47-216.719-153.781S92.966,71.232,195.276,53.852c62.919-10.688,126.962,11.29,170.059,58.361l-75.605,25.19c-8.944,2.976-13.781,12.638-10.806,21.582c0.001,0.002,0.002,0.005,0.003,0.007c2.976,8.944,12.638,13.781,21.582,10.806c0.003-0.001,0.005-0.002,0.007-0.002l102.4-34.133c6.972-2.322,11.675-8.847,11.674-16.196v-102.4C414.59,7.641,406.949,0,397.523,0s-17.067,7.641-17.067,17.067v62.344C292.564-4.185,153.545-0.702,69.949,87.19s-80.114,226.911,7.779,310.508s226.911,80.114,310.508-7.779C435.905,339.799,457.179,270.152,445.651,201.95z"/></g></svg>
      </a>
    </div>
  </div>
</div>

<header id="mudartexto">Atualizado<br>Escolha um canal abaixo para assistir</header>

<!-- Container para canais -->
<div id="listaCanais"></div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
  // Função para atualizar texto quando clicar no canal
  function atualizarTexto(nome) {
    document.getElementById('mudartexto').innerHTML = 'Você está assistindo:<br>' + nome;
  }

  // Função para criar o elemento do canal com seu estilo atual
  function criarCanal(canal, index) {
    // canal = {title, logo, link, category} (de exemplo)
    return `
      <a href="${canal.link}" onclick="window.scrollTo(0,0); atualizarTexto('${canal.title}')" target="VideoPlayer">
        <img src="${canal.logo}" class="iconelista" />
        <b>${canal.title}</b><br><g>${canal.category || ''}</g>
      </a>
    `;
  }

    // Carregar os canais diretamente da API oficial
  async function carregarCanais() {
    const url = "https://sinalpublico.vercel.app/channels.json";
    try {
      const response = await fetch(url);
      const canais = await response.json();

      // Inserir canais no seu layout
      const lista = document.getElementById('listaCanais');
      lista.innerHTML = canais.map((canal, i) => criarCanal({
        title: canal.name,
        logo: canal.image,
        link: canal.url,
        category: canal.category || ''
      }, i)).join('');

    } catch (err) {
      console.error('Erro ao carregar canais:', err);
      document.getElementById('listaCanais').innerHTML = '<p style="color:red; padding: 10px;">Erro ao carregar canais.</p>';
    }
  }

  carregarCanais();
</script>

</body>
</html>
