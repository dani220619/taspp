<div class="container">
    <!-- Outer Row -->
    <div class="row justify-content-center">
        <div class="col-lg-5">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg">
                            <div class="p-5">
                                <div class="text-center">
                                    <img src="<?= base_url('assets/img/aplikasi/logo.png') ?>" width="30%">
                                    <h1 class="h4 text-gray-900 mb-4 mt-2">Login Admin</h1>
                                </div>
                                <?= form_error('menu', '<div class="alert alert-danger close" role="alert">', '
                                </div>') ?>
                                <?= $this->session->flashdata('message') ?>
                                <form class="user" method="post" action="<?= base_url('auth'); ?>">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" value="<?= set_value('') ?>" name="email" id="email" aria-describedby="emailHelp" placeholder="Enter Email">
                                        <?= form_error('email', '<small class="text-danger pl-3">', ' </small>') ?>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password">
                                        <?= form_error('password', '<small class="text-danger pl-3">', ' </small>') ?>
                                    </div>
									<div class="form-group" style="display: flex;">
										<img src="<?=base_url()?>Auth/getCaptcha"/>
									    <input type="text" name="captcha" id="captcha" class="form-control" style="max-width: 150px;border-top-left-radius: 0;border-bottom-left-radius: 0;" maxlength='6' value="" placeholder="ketik captcha"/>
									    <?= form_error('captcha', '<small class="text-danger pl-3">', ' </small>') ?>
									</div>
									<button type="submit" class="btn btn-primary btn-user btn-block">
                                        Login
                                    </button>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="<?= base_url('auth/login_santri'); ?>">Masuk sebagai <b>SANTRI</b></a>
                                    </div>
                                </form>
                                <hr>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>