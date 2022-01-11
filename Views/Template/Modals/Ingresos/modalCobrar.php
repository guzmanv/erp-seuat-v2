<!-- Modal -->
<div class="modal fade" id="modalCobrar" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title">Cobro</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card card-secondary">
                    <form id="formGenerarEdoCuenta" name="formGenerarEdoCuenta">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 alert alert-warning" role="alert" id="alertSinServicio">
                                    No hay servicios seleccionados, por favor <b>selecciona uno</b>
                                </div>
                                <div class="col-12" id ="cobro">
                                    <div class="row">
                                            <div class="col-7 metodosPago">
                                                <h4 class="mt-2">Selecciona un método de Pago</h4>
                                                <div class="border p-3 mb-3 rounded">
                                                    <div class="row">
                                                        <div class="col-sm-8">
                                                            <div class="form-check">
                                                                <input type="radio" id="BillingOptRadio2" name="billingOptions" class="form-check-input" disabled>
                                                                <label class="form-check-label font-16 fw-bold" for="BillingOptRadio2">Paypal</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4 text-sm-end mt-3 mt-sm-0">
                                                            <img src="<?php echo media() ?>/images/img/paypal.png" height="25" alt="paypal-img">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="border p-3 mb-3 rounded">
                                                    <div class="row">
                                                        <div class="col-sm-8">
                                                            <div class="form-check">
                                                                <input type="radio" id="BillingOptRadio1" name="billingOptions" class="form-check-input" disabled>
                                                                <label class="form-check-label font-16 fw-bold" for="BillingOptRadio1">Tarjeta de crédito/débito</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4 text-sm-end mt-3 mt-sm-0">
                                                            <img src="<?php echo media() ?>/images/img/master.png" height="24" alt="master-card-img">
<!--                                                             <img src="<?php echo media() ?>/images/img/discover.png" height="24" alt="discover-card-img">
 -->                                                            <img src="<?php echo media() ?>/images/img/visa.png" height="24" alt="visa-card-img">
                                                            <!-- <img src="<?php echo media() ?>/images/img/stripe.png" height="24" alt="stripe-card-img"> -->
                                                        </div>
                                                    </div>
                                                    <div class="row mt-4" style="display:none">
                                                        <div class="col-md-12">
                                                            <div class="mb-3">
                                                                <label for="card-number" class="form-label">Card Number</label>
                                                                <input type="text" id="card-number" class="form-control" data-toggle="input-mask" data-mask-format="0000 0000 0000 0000" placeholder="4242 4242 4242 4242" maxlength="19">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row" style="display:none">
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label for="card-name-on" class="form-label">Name on card</label>
                                                                <input type="text" id="card-name-on" class="form-control" placeholder="Master Shreyu">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="mb-3">
                                                                <label for="card-expiry-date" class="form-label">Expiry date</label>
                                                                <input type="text" id="card-expiry-date" class="form-control" data-toggle="input-mask" data-mask-format="00/00" placeholder="MM/YY" maxlength="5">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="mb-3">
                                                                <label for="card-cvv" class="form-label">CVV code</label>
                                                                <input type="text" id="card-cvv" class="form-control" data-toggle="input-mask" data-mask-format="000" placeholder="012" maxlength="3">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="border p-3 mb-3 rounded">
                                                    <div class="row">
                                                        <div class="col-sm-8">
                                                            <div class="form-check">
                                                                <input type="radio" id="BillingOptRadio3" name="billingOptions" class="form-check-input" disabled>
                                                                <label class="form-check-label font-16 fw-bold" for="BillingOptRadio3">Transferencia</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="border p-3 mb-3 rounded">
                                                    <div class="row">
                                                        <div class="col-sm-8">
                                                            <div class="form-check">
                                                                <input type="radio" id="BillingOptRadio4" name="billingOptions" class="form-check-input" checked="">
                                                                <label class="form-check-label font-16 fw-bold" for="BillingOptRadio4">Efectivo</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-5 formPago"><br><br>
                                            <div class="border p-3 mt-4 mt-lg-0 rounded">
                                                <h4 class="header-title mb-3">Efectivo</h4>
                                                <div class="table-responsive">
                                                    <table class="table table-nowrap table-centered mb-0">
                                                        <tbody>
                                                            <!-- <tr>
                                                                <td>
                                                                    <p class="m-0 d-inline-block align-middle">
                                                                        <a href="apps-ecommerce-products-details.html" class="text-body fw-semibold">Biblio Plastic Armchair</a>
                                                                        <br>
                                                                        <small>1 x $129.99</small>
                                                                    </p>
                                                                </td>
                                                                <td class="text-end">$129.99</td>
                                                            </tr> -->
                                                            <tr class="text-end">
                                                                <td>
                                                                    <h6 class="m-0">Subtotal:</h6>
                                                                </td>
                                                                <td class="text-end"><span id="txtSubtotalModal"></span></td>
                                                            </tr>
                                                            <tr class="text-end">
                                                                <td>
                                                                    <h6 class="m-0">Descuentos:</h6>
                                                                </td>
                                                                <td class="text-end"><span id="txtDescuentoModal"></span></td>
                                                            </tr>
                                                            <tr class="text-end">
                                                                <td>
                                                                    <h5 class="m-0">Total:</h5>
                                                                </td>
                                                                <td class="text-end fw-semibold"><span id="txtTotalModal"></span></td>
                                                            </tr>
                                                        </tbody>
                                                    </table><br>
                                                    <input type="text" class="form-control" id="txtEfectivo" placeholder="Efectivo"/><br>
                                                    <div class="text-right"><button class="col-8 btn btn-outline-secondary btn-primary icono-color-principal btn-inline" onclick="btnCobrarCmbio()" ><i class="fas fa-fw fa-lg fa-hand-holding-usd icono-azul"></i></i><span>Cobrar</span></button></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-outline-secondary icono-color-principal btn-inline" href="#" data-dismiss="modal" id="cerrarModalGenerarEdoCuenta"><i class="fa fa-fw fa-lg fa-times-circle icono-azul"></i>Cancelar</a>
               </div>  
            </form> 
        </div>
    </div>
</div>