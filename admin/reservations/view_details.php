<?php
require_once('../../config.php');
if(isset($_GET['id'])){
  
    $qry = $conn->query("SELECT r.*,rr.name as room_name, rr.type as room_type from `reservation_list` r inner join `room_list` rr on r.room_id = rr.id where r.id = '{$_GET['id']}' ");
    if($qry->num_rows > 0){
        $res = $qry->fetch_array();
        foreach($res as $k => $v){
            if(!is_numeric($k)){
                $$k = $v;
            }
        }
    }else{
        echo '<script> alert("Unkown Reservation ID.");location.replace("./?page=reservations") </script>';
    }
} else{
    echo '<script> alert("Reservation ID is required to view this page.");location.replace("./?page=reservations") </script>';
}
$train_group = ['','First Class','Economy'];
?>
<style>
    #uni_modal .modal-footer{
        display:none;
    }
</style>
<div class="container-fluid">
    <fieldset class="border-bottom">
        <legend class="text-muted">Detalhes da Reserva</legend>
        <div class="row">
            <div class="col-md-6">
                <dl>
                    <dt class="text-muted">Código de Reserva</dt>
                    <dd class="pl-4"><?= isset($code) ? $code : 'N/A' ?></dd>
                </dl>
            </div>
            <div class="col-md-6">
                <dl>
                    <dt class="text-muted">Estado</dt>
                    <dd class="pl-4">
                        <?php 
                            switch ($status){
                                case 0:
                                    echo '<span class="rounded-pill badge badge-secondary col-6">Pendente</span>';
                                    break;
                                case 1:
                                    echo '<span class="rounded-pill badge badge-primary col-6">Confirmado</span>';
                                    break;
                                case 2:
                                    echo '<span class="rounded-pill badge badge-danger col-6">Cancelado</span>';
                                    break;
                            }
                        ?>
                    </dd>
                </dl>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <dl>
                    <dt class="text-muted">Data de Entrada</dt>
                    <dd class="pl-4"><?= isset($check_in) ? date("F d, Y", strtotime($check_in)) : 'N/A' ?></dd>
                </dl>
            </div>
            <div class="col-md-6">
                <dl>
                    <dt class="text-muted">Data de Saída</dt>
                    <dd class="pl-4"><?= isset($check_out) ? date("F d, Y", strtotime($check_out)) : 'N/A' ?></dd>
                </dl>
            </div>
        </div>
    </fieldset>
    <fieldset class="border-bottom">
        <legend class="text-muted">Detalhes do Quarto</legend>
        <div class="row">
            <div class="col-md-6">
                <dl>
                    <dt class="text-muted">Nome do Quarto</dt>
                    <dd class="pl-4"><?= isset($room_name) ? $room_name : 'N/A' ?></dd>
                </dl>
            </div>
            <div class="col-md-6">
                <dl>
                    <dt class="text-muted">Tipo de Quarto</dt>
                    <dd class="pl-4"><?= isset($room_type) ? $room_type : 'N/A' ?></dd>
                </dl>
            </div>
        </div>
    </fieldset>
    
    <fieldset class="border-bottom">
        <legend class="text-muted">Detalhes do Reservista</legend>
        <div class="row">
            <div class="col-md-6">
                <dl>
                    <dt class="text-muted">Nome Completo</dt>
                    <dd class="pl-4"><?= isset($fullname) ? ucwords($fullname) : 'N/A' ?></dd>
                </dl>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <dl>
                    <dt class="text-muted">Contacto</dt>
                    <dd class="pl-4"><?= isset($contact) ? $contact : 'N/A' ?></dd>
                    <dt class="text-muted">Endereço</dt>
                    <dd class="pl-4"><?= isset($address) ? $address : 'N/A' ?></dd>
                </dl>
            </div>
            <div class="col-md-6">
                <dl>
                    <dt class="text-muted">Email</dt>
                    <dd class="pl-4"><?= isset($email) ? $email : 'N/A' ?></dd>
                </dl>
            </div>
        </div>
    </fieldset>
    <div class="clear-fix my-2"></div>
    <div class="text-right">
        <button class="btn btn-sm btn-flat btn-primary" type="button" id="update_status"><i class="fa fa-edit"></i> Atualizar Estado</button>
        <button class="btn btn-sm btn-flat btn-dark" type="button" data-dismiss="modal"><i class="fa fa-times"></i> Fechar</button>
    </div>
</div>

<script>
   
   $(function(){
    $('#update_status').click(function(){
        uni_modal("Update <b><?= isset($code) ? $code : "N/A" ?> Reservation Status.</b>","reservations/update_status.php?id=<?= isset($id) ? $id : "" ?>&status=<?= isset($status) ? $status : '' ?>")
    })
   })
    
</script>