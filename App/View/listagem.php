<form name="formBusca" id="formBusca" method="POST" class="right">
    <p>
		<input type="text" placeholder="Busca por Nome" name="cli_nome" />
		<input type="submit" id="btnBuscar" value="Buscar">
    </p>
</form>

<table id="dados" summary="Clientes">
	<tr class='cabecalho'>
		<th>ID</th>
		<th>&nbsp;</th>
		<th>Nome</th>
		<th>E-mail</th>
		<th>Telefone</th>
		<th>Data Cad.</th>
		<th>&nbsp;</th>
		<th>&nbsp;</th>
	</tr>
					 
	<?php
		/*
		* Requisita os dados do grid
		*/
		if(!empty($_POST['cli_nome'])){
			$linkApi = "http://localhost/essentia/index.php/clienteByName/" . $_POST['cli_nome'];
		}
		else{
			$linkApi = "http://localhost/essentia/index.php/cliente";
		}

		$clientes = file_get_contents($linkApi);
		$arrStdClassClientes = json_decode($clientes);

		if(count($arrStdClassClientes)>0){
			for($i=0; $i<count($arrStdClassClientes); $i++){

				$cliente = new StdClass;
				$cliente = $arrStdClassClientes[$i];

    			if($i%2 == 0){
				     echo "<tr class='alter'>";
				     echo "	<td>".$cliente->cli_id."</td>";
				     echo "	<td><img src='../../".$cliente->cli_path_foto."' height='70' width='70'></td>";
				     echo "	<td>".$cliente->cli_nome."</td>";
				     echo "	<td>".$cliente->cli_email."</td>";
				     echo "	<td>".$cliente->cli_telefone."</td>";
				     echo "	<td>".date("d/m/Y", strtotime($cliente->cli_data_cad))."</td>";
				     echo "	<td><input type='submit' value='Deletar' onclick='handlerBtnDeletar(".$cliente->cli_id.")'></button></td>";
				     echo "	<td><input type='submit' value='Alterar' onclick='handlerBtnAlterar(".$cliente->cli_id.")'></button></td>";
				     echo "</tr>";
				} else {
				     echo "<tr>";
				     echo "	<td>".$cliente->cli_id."</td>";
				     echo "	<td><img src='../../".$cliente->cli_path_foto."' height='70' width='70'></td>";
				     echo "	<td>".$cliente->cli_nome."</td>";
				     echo "	<td>".$cliente->cli_email."</td>";
				     echo "	<td>".$cliente->cli_telefone."</td>";
				     echo "	<td>".date("d/m/Y", strtotime($cliente->cli_data_cad))."</td>";
				     echo "	<td><input type='submit' value='Deletar' onclick='handlerBtnDeletar(".$cliente->cli_id.")'></button></td>";
				     echo "	<td><input type='submit' value='Alterar' onclick='handlerBtnAlterar(".$cliente->cli_id.")'></button></td>";
				     echo "</tr>";
				}
    		}
		}	
	?>
</table>