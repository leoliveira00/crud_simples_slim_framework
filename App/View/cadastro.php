<input id="cli_id" name="cli_id" type="hidden" /> 
<input id="cli_path_foto" name="cli_path_foto" type="hidden" />
<fieldset>
  <legend>Cliente</legend>
  <table style="width: 100%;">
  <tbody>
    <tr>
      <td align="right">
        <p><label for="cli_nome"> Nome: <input id="cli_nome" name="cli_nome" size="30" type="text" /> </label></p>
        <p><label for="cli_email"> E-mail: <input id="cli_email" name="cli_email" size="30" type="text" /> </label></p>
        <p><label for="cli_telefone"> Telefone: <input id="cli_telefone" name="cli_telefone" size="30" type="text" /> </label></p>
      </td>
      <td style="width: 430;" align="right">
        <img id="imgFoto" width="120" height="120" />  
      </td>
    </tr>
    <tr>
      <td ><p align="right">Foto: <input id="imagem" name="imagem" type="file" /></p></td>
      <td style="width: 430px;" align="right"><input id="btnSalvar" type="submit" value="Salvar" onclick="handlerBtnSalvar()" /></td>
    </tr>
  </tbody>
  </table>
</fieldset>