<style>
    #uni_modal .modal-footer{
        display: none;
    }
</style>
<div class="conteiner-fluid">
    <form action="" id="reserve-form">
        <input type="hidden" name="id">
        <input type="hidden" name="room_id" value="<?= isset($_GET['rid']) ? $_GET['rid'] : '' ?>">
        <fieldset>
            <legend class="text-muted">Data da Reserva</legend>
            <div class="row">
                <div class="col-md-6">
                    <small class="mx-2">Data de Entrada <strong style="color: #bd0303;">*</strong></small>
                    <input type="date" name="check_in" min="<?= date('Y-m-d',strtotime(date('Y-m-d')." +1 day")) ?>" class="form-control form-control-sm form-control-border" required>
                    
                </div>
                <div class="col-md-6">
                    <small class="mx-2">Data de Saida <strong style="color: #bd0303;">*</strong></small>
                    <input type="date" name="check_out" class="form-control form-control-sm form-control-border" min="<?= date('Y-m-d',strtotime(date('Y-m-d')." +2 dias")) ?>" required>
                    
                </div>
            </div>
        </fieldset>
        <fieldset>
            <legend class="text-muted">Detalhes do Reservatório</legend>
            <div class="row">
                <div class="col-md-8">
                    <small class="mx-2">Nome completo <strong style="color: #bd0303;">*</strong></small>
                    <input type="text" name="fullname" class="form-control form-control-sm form-control-border" placeholder="Frederica Kalei" required>
                    
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <small class="mx-2">Contacto <strong style="color: #bd0303;">*</strong></small>
                    <input type="text" name="contact" class="form-control form-control-sm form-control-border" placeholder="9xxxxxxxxxxx" required>
                    
                </div>
                <div class="col-md-6">
                    <small class="mx-2">Email <strong style="color: #bd0303;">*</strong></small>
                    <input type="email" name="email" class="form-control form-control-sm form-control-border" placeholder="fred@gmail.com" required>
                    
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <small class="mx-2">Endereço <strong style="color: #bd0303;">*</strong></small>
                    <textarea rows="3" name="address" class="form-control form-control-sm" placeholder="Bairro Castanheira, Cuito, Província do Bié" required></textarea>
                </div>
            </div>
        </fieldset>
        <hr>
        <div class="my-2 text-right">
            <button class="btn btn-primary btn-flat btn-sm">Efetuar Reserva</button>
            <button class="btn btn-dark btn-flat btn-sm" type="button" data-dismiss='modal'><i class="fa fa-times"></i> Fechar</button>
        </div>
    </form>
</div>

<script>
   
   $(function(){
        $('#reserve-form').submit(function(e){
            e.preventDefault();
            var _this = $(this)
            $('.pop-msg').remove()
            var el = $('<div>')
                el.addClass("pop-msg alert")
                el.hide()
            start_loader();
            $.ajax({
                url:_base_url_+"classes/Master.php?f=save_reservation",
				data: new FormData($(this)[0]),
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
                dataType: 'json',
				error:err=>{
					console.log(err)
					alert_toast("Um erro ocorreu",'error');
					end_loader();
				},
                success:function(resp){
                    if(resp.status == 'success'){
                        // alert_toast("Success",'success')
                        location.reload();
                    }else if(!!resp.msg){
                        el.addClass("alert-danger")
                        el.text(resp.msg)
                        _this.prepend(el)
                    }else{
                        el.addClass("alert-danger")
                        el.text("Ocorreu um erro por motivo desconhecido.")
                        _this.prepend(el)
                    }
                    el.show('slow')
                    $('html,body').animate({scrollTop:0},'fast')
                    end_loader();
                }
            })
        })

   })
    
</script>