var peticion = function(recurso, tipo, ruta, funcion){
    $.ajax({
        async : false,
        url : ruta + '/nuevo/' + recurso,
        type : 'GET',
        dataType : tipo,
        success : function(msg){
            funcion(msg);
        }
    });
};

var salvar = function(datos , ruta){
    $.ajax({
        async : false,
        url : ruta + '/guardar',
        type : 'POST',
        dataType : 'json',
        data : datos,
        success : function(msg){
            
        }
    });
};

var datos = function(info){
    for( aux1 in info){
        $('#' + aux1).html('');
        if( aux1 === 'tipoNuevo'){
            $('#' + aux1).append('<option>-- Seleciona un tipo de Genero --</option>');
        }
        if(info[aux1].length === 0 ){
            $('#' + aux1).append("<option>Lista Vacia</option>");
        }
        var tipos = info[aux1];
        for( aux2 in tipos){

            var propiedades = tipos[aux2];
            var arregloPropiedades = new Array();
            for(aux3 in propiedades){
                arregloPropiedades[aux3] = propiedades[aux3];
            }
            $('#' + aux1).append("<option value='" + arregloPropiedades[0] + "'>" + arregloPropiedades[1] + "</option>");
        }
        $('#' + aux1).append("<option value='Nuevo'>Agregar Nuevo</option>");
    }
}; 
    
$(document).ready(function(){
    var local = this.location.origin + this.location.pathname;
    
    $('#form1').validate({
            rules:{
                titulo:{
                    required: true
                },
                cuerpo:{
                    required:true
                }
            },
            messages:{
                titulo:{
                    required: "Debe de introducir el titulo del Pos"
                },
                cuerpo:{
                    required: "Debe introducir el cuerpo del post"
                }
            }
            
            });

    $('.nuevo').change(function(){
        if( $(this).val() === 'Nuevo'){
            switch ($(this).attr('id')){
                case 'tipoNuevo':
                    peticion('nuevoModal/tipo','HTML', local, function(res){
                        $('#insertarModal').html(res);
                    });
                    break;
                case 'estadoNuevo':
                    peticion('nuevoModal/estado','HTML', local, function(res){
                        $('#insertarModal').html(res);
                    });
                    break;
                case 'modeloNuevo':
                    peticion('nuevoModal/modelo','HTML', local, function(res){
                        $('#insertarModal').html(res);
                    });
                    $('#tipoNuevoModal').html($('#tipoNuevo').html());
                    $('#tipoNuevoModal').val($('#tipoNuevo').val());
                    break;
                case 'unidadNuevo':
                    peticion('nuevoModal/unidad','HTML', local, function(res){
                        $('#insertarModal').html(res);
                    });
                    break;
            }
            $('#myModal').modal('show');
        }
        else{
            switch ($(this).attr('id')){
                case 'tipoNuevo':
                    peticion('modelo/' + $(this).val(),'JSON', local, datos);
                    break;
            }
        }
    });
    
    $('#salvarRecurso').click(function(){
        var data = $("#nuevoRecurso").serializeArray();
        data.push({name : 'tag', value : 'recurso'});
        
        salvar(data, local);
        $('#nuevoForm').hide();
    });
    
    $('#nuevoRecurso').submit(function(e){
        e.preventDefault();
        var data = $("#nuevoRecurso").serializeArray();
        data.push({name : 'tag', value : 'recurso'});
        
        salvar(data, local);
        $('#nuevoForm').hide();
    });
    
    $('#cancelarRecurso').click(function(){
        $('#nuevoRecurso').hide();
    });
    
    peticion('tipo','JSON', local, datos);
    peticion('estado','JSON', local, datos);
    peticion('unidad','JSON', local, datos);
});


