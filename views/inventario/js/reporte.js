$(document).ready(function(){
    
    $('.editarBtn').click(function() {
        console.log('ID: ' + $(this).attr('id'));
    });
    
    $('.editarBtn').click(function(){
        $.ajax({
            async : false,
            url : 'http://sctinvitado.mybluemix.net/inventario/editar/' + $(this).attr('id'),
            type: 'GET',
            dataType : 'html',
            success : function(msg){
                $('#editarForm').html(msg);
            }
        });
    });
});