<?php require_once "vistas/parte_superior.php"?>







<!--INICIO del cont principal-->
<div class="container">
    <h1>Administracion de Entradas y Salidas</h1>
    
    
    
 <?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$consulta = "SELECT id, nombre, identidad, caracteristicas, placa, referencia,fentrada, hentrada,hsalida FROM personas";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
?>


<div class="container">
        <div class="row">
            <div class="col-lg-12">            
            <button id="btnNuevo" type="button" class="btn btn-success" data-toggle="modal">Nuevo</button>    
            </div>    
        </div>    
    </div>    
    <br>  
<div class="container">
        <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">        
                        <table id="tablaPersonas" class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
                            <tr>
                                <th>Id</th>
                                <th>nombre</th>
                                <th>Identidad</th>
                                <th>caracteristicas</th>
                                <th>Placa</th>                                
                                <th>Referencia</th>  
                                <th>Fecha</th> 
                                <th>Hora Entrada</th> 
                                <th>Hora Salida</th>  
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php                            
                            foreach($data as $dat) {                                                        
                            ?>
                            <tr>
                                <td><?php echo $dat['id'] ?></td>
                                <td><?php echo $dat['nombre'] ?></td>
                                <td><?php echo $dat['identidad'] ?></td>
                                <td><?php echo $dat['caracteristicas'] ?></td>
                                <td><?php echo $dat['placa'] ?></td>
                                <td><?php echo $dat['referencia'] ?></td> 
                                <td><?php echo $dat['fentrada'] ?></td> 
                                <td><?php echo $dat['hentrada'] ?></td>                                 
                                <td><?php echo $dat['hsalida'] ?></td>   
                                <td></td>
                            </tr>
                            <?php
                                }
                            ?>                                
                        </tbody>        
                       </table>                    
                    </div>
                </div>
        </div>  
    </div>    
      
<!--Modal para CRUD-->
<div class="modal fade" id="modalCRUD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
        <form id="formPersonas">    
            <div class="modal-body">
                <div class="form-group">
                <label for="nombre" class="col-form-label">Nombre Completo:</label>
                <input type="text" class="form-control" id="nombre">
                </div>
                <div class="form-group">
                <label for="identidad" class="col-form-label">Identidad:</label>
                <input type="text" class="form-control" id="identidad">
                </div>  
                <div class="form-group">
                <label for="caracteristicas" class="col-form-label">Caracteristicas:</label>
                <input type="text" class="form-control" id="caracteristicas">
                </div>  
                <div class="form-group">
                <label for="placa" class="col-form-label">Placa:</label>
                <input type="text" class="form-control" id="placa">
                </div>                
                <div class="form-group">
                <label for="referencia" class="col-form-label">Referencia:</label>
                <input type="text" class="form-control" id="referencia">
                </div>      
                <div class="form-group">
                <label for="fentrada"  id="fechae" class="col-form-label">Fecha</label>
                <input type="date" class="form-control" id="fentrada" onblur="myFunction()">
                </div> 
                <div class="form-group">
                <label for="hentrada" class="col-form-label">Hora Entrada:</label>
                <input type="time" class="form-control" id="hentrada">
                </div>  
                
                <div class="form-group">
                <label for="hsalida" class="col-form-label">Hora Salida:</label>
                <input type="time" class="form-control" id="hsalida">
                </div>        
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                <button type="submit" id="btnGuardar" class="btn btn-dark">Guardar</button>
            </div>
        </form>    
        </div>
    </div>
</div>  
      
    
    
</div>



<!--FIN del cont principal-->

<?php require_once "vistas/parte_inferior.php"?>