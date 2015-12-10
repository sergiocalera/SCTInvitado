<?php

class inventarioModel extends Model{
    
    private $arreglo;
    private $cadenaQuery = "";
    
    public function __construct() {
        parent::__construct();
        $this->arreglo = array();
        $this->cadenaQuery = "select re.id, re.serie, mo.numero as numero_modelo, mo.descripcion as descripcion_modelo, ma.empresa, ma.descripcion as descripcion_empresa, ti.genero, ti.descripcion as descripcion_tipo, es.descripcion as estado, un.nombre_equipo, un.nombre_usuario, un.ip, ub.direccion " 
            . "FROM recursos re "
            . "INNER JOIN modelo mo ON re.modelo_id = mo.id "
            . "INNER JOIN marca ma ON mo.marca_id = ma.id "
            . "INNER JOIN tipo ti on mo.tipo_id = ti.id "
            . "INNER JOIN estado es on re.estado_id = es.id "
            . "INNER JOIN unidad un on re.unidad_id = un.id "
            . "INNER JOIN ubicacion ub on un.ubicacion_id = ub.id ";
    }
    
    public function getRecursos(){ 
        $post = $this->_db->query("select id,nombre_equipo from unidad");
        $arreglo['unidadNuevo'] = $post->fetchall();
        return $arreglo;
    }
    
    public function getReporteTipo($tipo){
        $sth = $this->_db->prepare($this->cadenaQuery . "WHERE ti.id = :tipo " . "ORDER BY re.serie");
        $sth->execute(array(':tipo'=>$tipo));
        $this->arreglo['reporte']= $sth->fetchall();
        return $this->arreglo;
    }
    
    public function getReporteNombre($nombre){
        $sth = $this->_db->query($this->cadenaQuery . "where un.nombre_usuario like ('%" . $nombre . "%') " . "ORDER BY re.serie");
        $this->arreglo['reporte']= $sth->fetchall();
        return $this->arreglo;
    }
    
    public function getTipo(){
        $this->arreglo['tipoNuevo'] = $this->_db->query("select id,genero from tipo")->fetchall();
        return $this->arreglo;
    }
    
    public function getModelo($id){
        $this->arreglo['modeloNuevo'] = $this->_db->query("select id,numero from modelo where tipo_id = $id")->fetchall();
        return $this->arreglo;
    }
    
    public function getEstado(){
        $this->arreglo['estadoNuevo'] = $this->_db->query("select id,descripcion from estado")->fetchall();
        return $this->arreglo;
    }
    
    public function getMarca(){
        $this->arreglo['marcaNuevo'] = $this->_db->query("select id,empresa from marca")->fetchall();
        return $this->arreglo;
    }
    
    public function getUnidad(){
        $this->arreglo['unidadNuevo'] = $this->_db->query("select id, nombre_equipo from unidad")->fetchall();
        return $this->arreglo;
    }
    
    public function getUbicacion(){
        $this->arreglo['ubicacionNuevo'] = $this->_db->query("select id, direccion from ubicacion")->fetchall();
        return $this->arreglo;
    }
    
    public function getEditar($id){
        $this->arreglo['id'] = $id;
        $this->arreglo['estado'] = $this->_db->query("select id, descripcion from estado")->fetchall();
        $this->arreglo['tipo'] = $this->_db->query("select id, genero from tipo")->fetchall();
        $this->arreglo['unidad'] = $this->_db->query("select id, nombre_equipo nombre from unidad")->fetchall();
        return $this->arreglo;
    }
    
    /*
     * Uso de los setters
     */
    
    public function setTipo($genero, $descripcion){
        $this->_db->prepare("INSERT INTO tipo VALUES(null, :genero, :descripcion)")
                ->execute(
                        array(
                            ':genero'=>$genero,
                            ':descripcion'=>$descripcion
                        ));
    }
    
    public function setModelo($numero, $descripcion, $marca_id, $tipo_id){
        $this->_db->prepare("INSERT INTO modelo VALUES(null, :numero, :descripcion, :marca_id, :tipo_id)")
                ->execute(
                        array(
                            ':numero'=>$numero,
                            ':descripcion'=>$descripcion,
                            ':marca_id'=>$marca_id,
                            ':tipo_id'=>$tipo_id
                        ));
    }
    
    public function setEstado($descripcion){
        $this->_db->prepare("INSERT INTO estado VALUES(null, :descripcion)")
                ->execute(
                        array(
                            ':descripcion'=>$descripcion
                        ));
    }
    
    public function setUnidad($equipo, $usuario, $ip, $ubicacion){
        $this->_db->prepare("INSERT INTO unidad VALUES(null, :nombre_equipo, :nombre_usuario, :ip, :ubicacion_id)")
                ->execute(
                        array(
                            ':nombre_equipo'=>$equipo,
                            ':nombre_usuario'=>$usuario,
                            ':ip'=>$ip,
                            ':ubicacion_id'=>$ubicacion
                        ));
    }
    
    public function setUbicacion($direccion){
        $this->_db->prepare("INSERT INTO ubicacion VALUES(null, :direccion)")
                ->execute(
                        array(
                            ':direccion' => $direccion
                        )
                        );
    }
    
    public function setMarca($empresa, $descripcion){
        $this->_db->prepare("INSERT INTO marca VALUES (null, :empresa, :descripcion)")
                ->execute(
                        array(
                            ':empresa' => $empresa,
                            ':descripcion' => $descripcion
                        )
                        );
    }
    
    public function setRecurso($modelo, $serie, $estado, $unidad){
        $this->_db->prepare("INSERT INTO recursos VALUES (null, :modelo, :serie, :estado, :unidad)")
                ->execute(
                        array(
                            ':modelo' => $modelo,
                            ':serie' => $serie,
                            ':estado' => $estado,
                            ':unidad' => $unidad,
                        )
                        );
    }
    
    public function setEditar($id, $modelo, $serie, $estado, $unidad){
        $this->_db->prepare("UPDATE recursos SET id = :id, modelo_id = :modelo, serie = :serie, estado_id = :estado, unidad_id = :unidad WHERE id = :id")
                ->execute(
                        array(
                            ':id' => $id,
                            ':modelo' => $modelo,
                            ':serie' => $serie,
                            ':estado' => $estado,
                            ':unidad' => $unidad,
                        )
                        );
    }
}