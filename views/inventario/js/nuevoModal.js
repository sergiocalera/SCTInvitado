$(document).ready(function(){
    var local = this.location.origin + this.location.pathname;
    
    $('.nuevoModal').change(function(){
        if( $(this).val() === 'Nuevo'){
            var aux = $(this).attr('id');
            renderizar(aux);
        }
    });
    
    var renderizar = function(aux){
        $('#myModal').modal('hide');
        $('#myModal').on('hidden.bs.modal',function(){
            switch (aux){
                case 'marcaNuevoModal':
                    peticion('nuevoModal/marca','HTML', local , function(res){
                        $('#insertarModal').html(res);
                    });
                    break;
                case 'tipoNuevoModal':
                    peticion('nuevoModal/tipo','HTML', local, function(res){
                        $('#insertarModal').html(res);
                    });
                    break;
                case 'ubicacionNuevoModal':
                    peticion('nuevoModal/ubicacion','HTML', local, function(res){
                        $('#insertarModal').html(res);
                    });
                    break;
            }
            $('#myModal').modal('show');
        });
    };
    
    var datos = function(info){
        for( aux1 in info){
            $('#' + aux1 + 'Modal').html('');
            if(info[aux1].length === 0 ){
                $('#' + aux1 + 'Modal').append("<option>Lista Vacia</option>");
            }
            else{
                $('#' + aux1 + 'Modal').append("<option>-- Seleciona una Opción --</option>");
            }
            var tipos = info[aux1];
            for( aux2 in tipos){
                
                var propiedades = tipos[aux2];
                var arregloPropiedades = new Array();
                for(aux3 in propiedades){
                    arregloPropiedades[aux3] = propiedades[aux3];
                }
                $('#' + aux1 + 'Modal').append("<option value='" + arregloPropiedades[0] + "'>" + arregloPropiedades[1] + "</option>");
            }
            $('#' + aux1 + 'Modal').append("<option value='Nuevo'>Agregar Nuevo</option>");
        }
    };   
    
//    if($('#myModalLabel').html() === 'NUEVO MODELO'){
//        peticion('marca','JSON',datos);
//    }
    switch ($('#myModalLabel').html()) {
        case 'NUEVO MODELO':
            peticion('marca','JSON', local, datos);
            break;
        case 'NUEVO UNIDAD':
            peticion('ubicacion','JSON', local, datos);
            break;
        default:
            break;
    }
});