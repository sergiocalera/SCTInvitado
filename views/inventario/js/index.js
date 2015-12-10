$(document).ready(function(){
    
    var local = this.location.origin + this.location.pathname;
    
    var envio = function(data){
        $.ajax({
            async : false,
            url : local + '/reporte',
            type : 'POST',
            dataType : 'html',
            data : data,
            success : function(msg){
                $('#areaReporte').html(msg);
            }
        });
    };
    
    $('#buscarIndexTipo').click(function(){
        var data = $('#formIndexTipo').serializeArray();
        data.push({name : 'tag', value : 'reporteTipo'});
        envio(data);
    });
    
    $('#buscarIndexNombre').click(function(){
        var data = $('#formIndexNombre').serializeArray();
        data.push({name : 'tag', value : 'reporteNombre'});
        envio(data);
    });
    
    $('#formIndexNombre').submit(function(e){
        e.preventDefault();
        var data = $('#formIndexNombre').serializeArray();
        data.push({name : 'tag', value : 'reporteNombre'});
        envio(data);
    }); 
    
    $('#nuevoBtn').click(function(){
        $('#nuevoForm').show();
        $.ajax({
            url : local + '/nuevo',
            type : 'GET',
            dataType : 'html',
            success : function(msg){
                $('#nuevoForm').html(msg);
            }
        });
    });
    
    
});