
$(function() {
    $( "#container" ).tabs();
});

function handlerBtnDeletar(cli_id) {
    
    if(confirm("Confirma a exclusão do cliente " + cli_id + " ?")){
        $.ajax({
            url: 'http://localhost/essentia/index.php/cliente/' + cli_id,
            type: 'DELETE',
            success: function(result) {
                document.getElementById("formBusca").submit();
            },
            error: function(err) { console.log(err);
                alert(err.statusText);
            }
        });
    }

    return false;
}

function handlerBtnAlterar(id) {
    
    var index = $('#container a[href="#aba"]').parent().index();
    $("#container").tabs("option", "active", index);

    $.ajax({
        url: 'http://localhost/essentia/index.php/clienteById/' + id,
        type: 'GET',
        success: function (data) {

            // JAX-RS serializes an empty list as null, and a 'collection of one' as an object (not an 'array of one')
            var list = data == null ? [] : (data instanceof Array ? data : [data]);    
            cliente = JSON.parse(data);
            
            document.getElementById('cli_id').value = cliente.cli_id;
            document.getElementById('cli_path_foto').value = cliente.cli_path_foto;
            document.getElementById('cli_nome').value = cliente.cli_nome;
            document.getElementById('cli_email').value = cliente.cli_email;
            document.getElementById('cli_telefone').value = cliente.cli_telefone;
            
            if(cliente.cli_path_foto!=null){
                src = "http://localhost/essentia/" + cliente.cli_path_foto;
                document.getElementById('imgFoto').src = src;
            }

        },        
        error: function(jqXHR, textStatus, errorThrown){
            alert('ERRO: ' + textStatus);
        }
    });
}

function handlerBtnSalvar() {
    var index = $('#container a[href="#aba"]').parent().index();
    $("#container").tabs("option", "active", index);

    if(document.getElementById('cli_id').value != ''){
        updateCliente();
    }
    else{
        insertCliente();
    }
}

function updateCliente(){

    document.getElementById("imagem").disabled = true;

    $.ajax({
        url: 'http://localhost/essentia/index.php/cliente/' + $('#cli_id').val(),
        type: 'PUT',
        contentType: 'application/json',
        dataType: 'json',
        data: JSON.stringify({
            "cli_id": $('#cli_id').val(), 
            "cli_nome": $('#cli_nome').val(), 
            "cli_telefone": $('#cli_telefone').val(),
            "cli_email": $('#cli_email').val(),
            "cli_path_foto": $('#cli_path_foto').val()
        }),
        success: function(result) {
            alert(result.message);
            $("#container").tabs("option", "active", 0);
            document.getElementById("formBusca").submit();
            
            $('#cli_id').val == '';
            $('#cli_path_foto').val == '';
            $('#cli_nome').val == '';
            $('#cli_email').val == '';
            $('#cli_telefone').val == '';
        },
        error: function(err) {
            console.log(err);
            alert(err.statusText);
        }
    });
}

function insertCliente(){

    formData = new FormData();
    formData.append('cli_nome', document.getElementById('cli_nome').value);
    formData.append('cli_email', document.getElementById('cli_email').value);
    formData.append('cli_telefone', document.getElementById('cli_telefone').value);
    formData.append('imagem', document.querySelectorAll('input[type=file]')[0].files[0]);
        
    $.ajax({
        url: 'http://localhost/essentia/index.php/cliente',
        type: 'POST',
        data: formData,   
        processData: false,  
        contentType: false,
        success: function(result) {
            alert(result.message);
            $("#container").tabs("option", "active", 0);
            document.getElementById("formBusca").submit();
        },
        error: function(err) {
            console.log(err);
            alert('Erro: '+err.statusText);
        }
    });
}