<div class="container">
  <div class="card o-hidden border-0 shadow-lg my-5 col-lg-7 mx-auto">
    <div class="card-body p-0">
      <!-- Nested Row within Card Body -->
      <div class="row">
        <div class="col-lg">
          <div class="p-5">
            <div class="text-center">
              <h1 class="h4 text-gray-900 mb-4">Registrasi User Walletz</h1>
            </div>
            <form class="user" method="post" action="<?= base_url('register'); ?>">
              <div class="form-group">
                <input type="text" class="form-control form-control-user" id="name" name="name" placeholder="Nama Lengkap" value="<?= set_value('name'); ?>"> <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
              </div>
              <div class="form-group">
                <input type="text" class="form-control form-control-user" id="email" name="email" placeholder="Alamat E-mail" value="<?= set_value('email'); ?>"> <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
              </div>
              <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password"> <?= form_error('password','<small class="text-danger pl-3">', '</small>'); ?> 
              </div>
                <div class="col-sm-6">
                  <input type="password" class="form-control form-control-user" id="confirm_password" name="confirm_password" placeholder="Confirm Password"> <?= form_error('confirm_password','<small class="text-danger pl-3">', '</small>'); ?>
                </div>
              </div>
              <button type="submit" class="btn btn-primary btn-user btn-block">
                 Registrasi User
                </button>
										</form>
										<hr>
          <div class="text-center"> Sudah Memiliki User? <a class="small" href="<?= base_url('login'); ?>"> Login! </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>