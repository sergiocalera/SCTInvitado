<!DOCTYPE html>
<html lang="es">
    <head>
        <title><?php if(isset($this->titulo)){ echo $this->titulo;}?></title>
        <meta http-equiv="Content-Type" content="tetx/html" charset="UTF-8">
        <link href="<?php echo $_layoutParams['ruta_css']?>estilos.css" rel="stylesheet" type="text/css" />
        <script src=<?php echo BASE_URL."public/js/jquery-1.11.2.min.js"; ?> type="text/javascript"></script>
        <script src=<?php echo BASE_URL."public/js/jquery.validate.js"; ?> type="text/javascript"></script>
        <link href="<?php echo BASE_URL."public/css/bootstrap.min.css"?>" rel="stylesheet" type="text/css" />
        <?php if(isset($_layoutParams['js']) && count($_layoutParams['js'])):?>
        <?php for($i=0; $i< count($_layoutParams['js']); $i++):?>
        <script src=<?php echo $_layoutParams['js'][$i] ?> type="text/javascript"></script>
        <?php endfor;?>
        <?php endif;?>
    </head>
    <body>
        <div class="row">
            <div class="col-md-12">
                <div id="main">
                    <div id="header">
                        <h1><?php echo APP_NAME;?></h1>
                    </div>

                    <div id="menu_top">
                        <?php if(isset($_layoutParams['menu'])): ?>
                        <?php foreach ($_layoutParams['menu'] as $aux): ?>
                        <p>
                            <a href='<?php echo $aux['enlace']; ?>'>
                                <button type="button" class="btn btn-primary btn-lg btn-block">
                                    <?php echo $aux['titulo'] ?>
                                </button>
                            </a>
                        </p>
                        <?php endforeach;?>
                        <?php endif;?>
                    </div>
                </div>

                <div id="content">
                    <noscript><p>Para el correcto funcionamiento debe de tener el soporte de javascipt habilitado</p></noscript>
                    <div id="error">
                        <?php
                        if(isset($this->error)){
                            echo $this->error;
                        }
                        ?>
                    </div>
                </div>