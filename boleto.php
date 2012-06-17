
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
	  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html lang="pt-br" xmlns="http://www.w3.org/1999/xhtml"> 
  <head>
    <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" /> 
    <title>Sua Moda - Boleto 000014238725</title>
    <style type="text/css">
      a:link, a:vlink { text-decoration: none; }
      p.tiny { font-family: Verdana; font-size: 6pt; }
      div.small, p.small, td.small { font-family: Verdana; font-size: 7pt; }
      div.normal, p.normal { font-family: Verdana; font-size: 8pt; }
      p.large, pre.large, div.large { font-family: Verdana; font-size: 9pt; }
    </style>
  </head>

  <body>
	<?php
		//$amanha = date('d/m/Y', strtotime("+1 day"));
		
		//Iniciando a sessão
		session_start();
		include_once 'connect.php';
		if(isset($_SESSION['logado']))
		{
			$sql = "SELECT * FROM usuario WHERE idusuario = ".$_SESSION['id_user'];
			$rs = mysql_query($sql);
			$user = mysql_fetch_array($rs);
			
			$imagem_tutulo = 'picture/r.png';
			$imagem_banco = 'picture/banco.gif';
			$codigo_barra = 'picture/barra.png';
			
			$nome = $user["Nome"]; //'Robinho';
			$data_atual = date('d/m/Y'); //'2012'; //data atual
			$vencimento = date('d/m/Y', strtotime("+1 day")); //data um dia a mais do que a atual
			$nao_receber_apos = date('d/m/Y', strtotime("+9 day")); //data atual mais 9 dias
			$valor_total = '99,99'; //valor total
			$endereco = $user["rua"] . " " . $user["numero"] . " " . $user["bairro"]; //'rua a '.'1000'; //endereço, número e bairro
			$cpf = $user["cpf"];//'000000000'; //cpf dããããããããa
		}
	?>
	
    <div style="width:640px">
      <div style="float:left; width:30%">
	<img src=<?php echo $imagem_tutulo; ?> alt="Registro.br"/>
      </div>
      <div class="small" style="text-align:right; width:99%">
	N&uacute;cleo de Informa&ccedil;&atilde;o e Coordena&ccedil;&atilde;o
	do Ponto BR - NIC.BR<br/>Av. das Nações Unidas, 11541, 7° andar<br/>
	04578-000 - S&atilde;o Paulo - SP<br/>CNPJ: 05.506.560/0001-36<br/>
	CCM: 3.198.078-3<br/><a href="https://nfe.prefeitura.sp.gov.br/contribuinte/notaprint.aspx?inscricao=31980783&nf=9729278&verificacao=FR6UAFBI">NF-e: 9729278, C&oacute;digo de Verifica&ccedil;&atilde;o: FR6UAFBI</a>
      </div>
      <div style="float:left; width:30%">
	<img src=<?php echo $imagem_banco; ?> alt="Logo Banco"/>
      </div>
      <div style="height:35px; width:98%">&nbsp;</div>
      <div class="small"
	   style="text-align:right; width:99%;">
	<b>RECIBO DO SACADO</b>
      </div>

      <div style="clear:left">
      <table width="99%" border="1" cellspacing="0" cellpadding="1">
	<tr>
	  <td colspan="3">
	    <div class="small">Cedente</div>
	    <div class="normal">NIC.BR - CNPJ: 05.506.560/0001-36</div>
	  </td>
	  <td align="right">
	    <div class="small">Vencimento</div>
	    <div class="normal"><b><?php echo $vencimento; ?></b></div>
	  </td>
	</tr>
	<tr>
	  <td>
	    <div class="small">Sacado</div>
	    <div class="normal">
	      <?php echo $nome; ?><br/>CPF: 105.137.356-58
	    </div>
	  </td>
	  <td>
	    <div class="small">N&uacute;mero do Documento</div>
	    <div class="normal">000014238725</div>
	  </td>
	  <td>
	    <div class="small">Nosso N&uacute;mero</div>
	    <div class="normal">000014238725 8</div>
	  </td>
	  <td align="right">
	    <div class="small">Valor do Documento</div>
	    <div class="normal"><b><?php echo $valor_total; ?></b></div>
	  </td>
	</tr>
	<tr>
	  <td colspan="4">
	    <div class="small">Demonstrativo</div>
	    <!--<p class="normal" style="margin-left:15px">
	      Dom&iacute;nio: <b>rogerioap.com.br</b><br/>
	      &nbsp;Manuten&ccedil;&atilde;o de 11/03/2012 a 10/03/2013&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; R$ 30.00<br/>
	    </p>-->
	    <p class="small">
	      ISS de 5,00% e COFINS de 7,60% j&aacute;
	      inclusos no valor total do boleto. O NIC.BR declara para fins
	      de não incidência na fonte do IRPJ, da CSLL e da contribuição
	      para PIS/PASEP ser associação sem fins lucrativos, enquadrada
	      nas Leis n&ordm; 10.637/02 e n&ordm; 9.532/97.
	    </p>
	    <div class="small">
	      O Titular do dom&iacute;nio deste boleto banc&aacute;rio, ao
	      efetuar o pagamento do mesmo, manifesta sua concord&acirc;ncia
	      com os termos do "Contrato para registro de dom&iacute;nio do
	      Registro.br"; o texto do Contrato encontra-se no site
	      http://registro.br/contrato/contrato.html.
	      
	    </div>
	  </td>
	</tr>
      </table>
      </div>
      <div class="small" style="text-align:right; width:99%">
	<b>Autentica&ccedil;&atilde;o Mec&acirc;nica</b>
      </div>

      <br/>
      <div style="width:95%; float:left">
	<hr/>
      </div>
      <p class="tiny" style="text-align:right">&nbsp;dobre</p>

      <div style="float:left; width:30%">
	<img src=<?php echo $imagem_banco; ?> alt="Logo Banco"/>
      </div>
      <div style="height:35px; width:100%">&nbsp;</div>
      <div class="normal" style="text-align:right; width:99%">
	<b>03399.19300  87700.001420  38725.801021  9  53450000003000</b>
      </div>
      <div style="clear:left">
	<table width="99%" border="1" cellspacing="0" cellpadding="1">
	  <tr>
	    <td colspan="5">
	      <div class="small">Local de Pagamento</div>
	      <div class="normal">
		AT&Eacute; O VENCIMENTO PAG&Aacute;VEL EM QUALQUER BANCO
	      </div>
	    </td>
	    <td align="right">
	      <div class="small">Vencimento</div>
	      <div class="normal"><b><?php echo $vencimento; ?></b></div>
	    </td>
	  </tr>

	  <tr>
	    <td colspan="5">
	      <div class="small">Cedente</div>
	      <div class="normal">NIC.BR - CNPJ: 05.506.560/0001-36</div>
	    </td>
	    <td align="right">
	      <div class="small">Ag&ecirc;ncia / Ident. Cedente</div>
	      <div class="normal">105 / 1930877</div>
	    </td>
	  </tr>

	  <tr>
	    <td>
	      <div class="small">Data Documento</div>
	      <div class="normal"><?php echo $data_atual; ?></div>
	    </td>
	    <td>
	      <div class="small">N&uacute;mero Documento</div>
	      <div class="normal">000014238725</div>
	    </td>
	    <td>
	      <div class="small">Esp&eacute;cie Documento</div>
	      <div class="normal">RC-CI</div>
	    </td>
	    <td>
	      <div class="small">Aceite</div>
	      <div class="normal">N</div>
	    </td>
	    <td>
	      <div class="small">Data Processamento</div>
	      <div class="normal"><?php echo $data_atual; ?></div>
	    </td>
	    <td align="right">
	      <div class="small">Nosso N&uacute;mero</div>
	      <div class="normal">000014238725 8</div>
	    </td>
	  </tr>

	  <tr>
	    <td colspan="2">
	      <div class="small">Carteira</div>
	      <div class="normal">102 - COBRAN&Ccedil;A SIMPLES</div>
	    </td>
	    <td>
	      <div class="small">Esp&eacute;cie</div>
	      <div class="normal">REAL</div>
	    </td>
	    <td>
	      <div class="small">Quantidade</div>
	      <div class="normal">&nbsp;</div>
	    </td>
	    <td>
	      <div class="small">Valor</div>
	      <div class="normal">&nbsp;</div>
	    </td>
	    <td align="right">
	      <div class="small">Valor do Documento</div>
	      <div class="normal"><b><?php echo $valor_total; ?></b></div>
	    </td>
	  </tr>

	  <tr>
	    <td colspan="5" rowspan="4">
	      <p class="small"><b>Instru&ccedil;&otilde;es</b></p>
	      <div class="small"><b>
		  N&Atilde;O RECEBER APOS <?php echo $nao_receber_apos; ?><br/>
		  N&Atilde;O COBRAR JUROS DE MORA<br/>
		  N&Atilde;O RECEBER MENOS QUE R$ <?php echo $valor_total; ?>
		  (manuten&ccedil;&atilde;o pelo per&iacute;odo m&iacute;nimo
		  de 1 ano)
	      </b></div>
	    </td>
	    <td >
	      <div class="small">(+) Outros Acr&eacute;scimos</div>
	    </td>
	  </tr>
	  
	  <tr>
	    <td>
	      <div class="small">(-) Descontos/Abatimento</div>
	    </td>
	  </tr>
	  
	  <tr>
	    <td>
	      <div class="small">(+) Mora/Multa</div>
	    </td>
	  </tr>
	  
	  <tr>
	    <td>
	      <div class="small">(=) Valor Cobrado</div>
	    </td>
	  </tr>
	  
	  <tr>
	    <td colspan="6">
	      <div class="small">Sacado</div>
	      <div class="normal">
			<?php echo $nome; ?><br/><?php echo $endereco; ?><br/><?php echo $cpf; ?>
	      </div>
	    </td>
	  </tr>
	</table>
      </div>
      <div class="small"
	   style="text-align:right; width:99%">
	<b>
	  Autentica&ccedil;&atilde;o Mec&acirc;nica /
	  FICHA DE COMPENSA&Ccedil;&Atilde;O
	</b>
      </div>

      <div>
	<img src=<?php echo $codigo_barra; ?>
	     alt="Código de barras"/>
      </div>

      <div style="width:95%; float:left">
	<hr/>
      </div>
      <p class="tiny" style="text-align:right">&nbsp;corte</p>

      <div class="normal">
	
      </div>
    </div>

  </body>
</html>

<!-- Registro .br (c) 1998/2011 -->