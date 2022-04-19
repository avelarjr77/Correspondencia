<?= $this->extend('template/admin_template') ?>
<?= $this->section('content') ?>

<!-- page content -->

<div class="clearfix"></div>

<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Configuración de Persona</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <form class="" action="" method="post" novalidate="">
                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-3  label-align">Nombres<span class="required ">*</span></label>
                        <div class="col-md-6 col-sm-6">
                            <input class="form-control" data-validate-length-range="6" data-validate-words="2" name="nombres" required="required">
                            <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                        </div>
                    </div>
                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-3  label-align">Primer Apellido<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6">
                            <input class="form-control" name="occupation" data-validate-length-range="5,15" type="text">
                        </div>
                    </div>
                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-3  label-align">Segundo Apellido<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6">
                            <input class="form-control" name="segundoApellido" required="required" type="text">
                        </div>
                    </div>
                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-2 label-align">Fecha de Nacimiento<span class="required">*</span></label>
                        <div class="col-md-3 col-sm-3">
                            <input class="form-control" type="date" name="confirm_email" data-validate-linked="email" required="required">
                        </div>
                        <label class="col-form-label col-sm-1 label-align">Genero <span class="required">*</span></label>
                        <div class="col-md-2 col-sm-2">
                            <select class="form-control">
                                <option>Genero</option>
                                <option>Masculino</option>
                                <option>Femenino</option>
                            </select>
                        </div>
                    </div>
                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-2 label-align">Cargo <span class="required">*</span></label>
                        <div class="col-md-2 col-sm-2">
                            <select class="form-control">
                                <option>Cargo</option>
                                <option>1</option>
                                <option>2</option>
                            </select>
                        </div>
                        <label class="col-form-label col-sm-1 label-align">Departamento<span class="required">*</span></label>
                        <div class="col-md-3 col-sm-3">
                            <select class="form-control">
                                <option>Departamento</option>
                                <option>1</option>
                                <option>2</option>
                            </select>
                        </div>
                    </div>
                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-1 label-align">Celular<span class="required">*</span></label>
                        <div class="col-md-2 col-sm-2">
                            <input type="text" class="form-control" data-inputmask="'mask' : '(999) 999-9999'">
                            <span class="fa fa-whatsapp form-control-feedback right" aria-hidden="true"></span>
                        </div>
                        <label class="col-form-label col-sm-1 label-align">Correo<span class="required">*</span></label>
                        <div class="col-md-3 col-sm-3">
                            <input type="email" class="form-control" data-inputmask="'mask' : '(999) 999-9999'">
                            <span class="fa fa-envelope form-control-feedback right" aria-hidden="true"></span>
                        </div>
                    </div>
                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-3  label-align">Time<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6">
                            <input class="form-control" type="time" name="time" required="required">
                        </div>
                    </div>

                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-3  label-align">Password<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6">
                            <input class="form-control" type="password" id="password1" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&amp;*]).{8,}" title="Minimum 8 Characters Including An Upper And Lower Case Letter, A Number And A Unique Character" required="">

                            <span style="position: absolute;right:15px;top:7px;" onclick="hideshow()">
                                <i id="slash" class="fa fa-eye-slash"></i>
                                <i id="eye" class="fa fa-eye"></i>
                            </span>
                        </div>
                    </div>

                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-3  label-align">Repeat password<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6">
                            <input class="form-control" type="password" name="password2" data-validate-linked="password" required="required">
                        </div>
                    </div>
                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-3  label-align">Telephone<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6">
                            <input class="form-control" type="tel" name="phone" required="required" data-validate-length-range="8,20">
                        </div>
                    </div>
                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-3  label-align">message<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6">
                            <textarea required="required" name="message"></textarea>
                        </div>
                    </div>
                    <div class="ln_solid">
                        <div class="form-group">
                            <div class="col-md-6 offset-md-3">
                                <button type="submit" class="btn btn-primary btn-xs">Agregar Persona</button>
                                <button type="reset" class="btn btn-success btn-xs">Limpiar Formulario</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->
<?= $this->endSection() ?>