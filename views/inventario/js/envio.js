$(document).ready(function(){
    var local = this.location.origin + this.location.pathname;
    
    $('#nuevoModal').submit(function(e){
        e.preventDefault();
        recopilar();
    });
    
    $('#salvar').click(function(){
        recopilar();
    });
    
    var recopilar = function(){
        var data = $('#nuevoModal').serializeArray();
        switch ($('#nuevoModal').attr('class')){
            case 'form-horizontal TIPO':
                data.push({name: 'tag', value: 'tipo'});
                break;
            case 'form-horizontal MODELO':
                data.push({name: 'tag', value: 'modelo'});
                break;
            case 'form-horizontal ESTADO':
                data.push({name : 'tag', value: 'estado'});
                break;
            case 'form-horizontal MARCA':
                data.push({name: 'tag', value: 'marca'});
                break;
            case 'form-horizontal UNIDAD':
                data.push({name: 'tag', value: 'unidad'});
                break;
            case 'form-horizontal UBICACION':
                data.push({name: 'tag', value: 'ubicacion'});
        }
        
        enviar(data);
        $('#myModal').modal('hide');
    };
    
    var enviar = function(datos){
        $.ajax({
            async : false,
            url: local + '/guardar',
            type: 'POST',
            dataType: 'json',
            data: datos,
            success: function(msg){
            }
        });
    };
});
