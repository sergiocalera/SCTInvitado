<?php

class inventarioController extends Controller{
    
    private $_post;
    
    public function __construct() {
        parent::__construct();
        $this->_post = $this->loadModel('inventario');
    }
    
    public function index(){
        
        $this->_view->elementos = $this->_post->getTipo();
        $this->_view->titulo = 'Inventario';
        $this->_view->renderizar('index');
    }
    
    public function reporte(){
        switch ($this->getPostParam('tag')){
            case 'reporteTipo':
                $this->_view->renderizarPeticion('reporte', $this->_post->getReporteTipo($this->getPostParam('tipo')));
                break;
            case 'reporteNombre':
                $this->_view->renderizarPeticion('reporte', $this->_post->getReporteNombre($this->getPostParam('nombre')));
                break;
        }
    }
    
    public function guardar(){
        switch($this->getPostParam('tag')){
            case 'tipo':
                $this->_post->setTipo(
                        $this->getPostParam('genero'),
                        $this->getPostParam('descripcion')
                        );
                $this->_view->renderizarPeticion('respuesta', $this->_post->getTipo());
                break;
            case 'modelo':
                $this->_post->setModelo(
                        $this->getPostParam('numero'),
                        $this->getPostParam('descripcion'),
                        $this->getPostParam('marca'),
                        $this->getPostParam('tipo')
                        );
                break;
            case 'estado':
                $this->_post->setEstado(
                        $this->getPostParam('descripcion')
                        );
                break;
            case 'unidad':
                $this->_post->setUnidad(
                        $this->getPostParam('nombre_equipo'),
                        $this->getPostParam('nombre_usuario'),
                        $this->getPostParam('ip'),
                        $this->getPostParam('ubicacion')
                        );
                break;
            case 'ubicacion':
                $this->_post->setUbicacion(
                        $this->getPostParam('direccion')
                        );
                break;
            case 'marca':
                $this->_post->setMarca(
                        $this->getPostParam('empresa'),
                        $this->getPostParam('descripcion')
                        );
                break;
            case 'recurso':
                $this->_post->setRecurso(
                        $this->getPostParam('modelo'),
                        $this->getPostParam('serie'),
                        $this->getPostParam('estado'),
                        $this->getPostParam('unidad')
                        );
                break;
        }
    }
    
    public function nuevo($req = false, $id = false){
        switch ($req){
            case 'recursos':
                $this->_view->renderizarPeticion('respuesta', $this->_post->getRecursos());
                break;
            case 'tipo':
                $this->_view->renderizarPeticion('respuesta', $this->_post->getTipo());
                break;
            case 'estado':
                $this->_view->renderizarPeticion('respuesta', $this->_post->getEstado());
                break;
            case 'modelo':
                $this->_view->renderizarPeticion('respuesta', $this->_post->getModelo($id));
                break;
            case 'nuevoModal':
                $this->_view->renderizarPeticion('nuevoModal',$id);
                break;
            case 'marca':
                $this->_view->renderizarPeticion('respuesta', $this->_post->getMarca());
                break;
            case 'unidad':
                $this->_view->renderizarPeticion('respuesta', $this->_post->getUnidad());
                break;
            case 'ubicacion':
                $this->_view->renderizarPeticion('respuesta', $this->_post->getUbicacion());
                break;
            default :
                $this->_view->renderizarPeticion('nuevo');
                break;
        }
    }
    
    public function editar($id = false){
        $this->_view->renderizarPeticion('editar', $this->_post->getEditar($id));
    }
    
    public function salvarEditar(){
        $this->_post->setEditar(
            $this->getPostParam('id'),
            $this->getPostParam('modelo'),
            $this->getPostParam('serie'),
            $this->getPostParam('estado'),
            $this->getPostParam('unidad')
                );
    }
    
    public function eliminar($id){
        
        Session::acceso('admin');
        
        if(!$this->filtrarInt($id)){
            $this->redireccionar('post');
        }
        
        if(!$this->_post->getPost($this->filtrarInt($id))){
            $this->redireccionar('post');
        }
        
        $this->_post->eliminarPost($this->filtrarInt($id));
        $this->redireccionar('post');
    }
    
}