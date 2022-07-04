<div class="row">
	<div class="col-lg-12">
		<form action="<?php echo CURRENT_URL ?>" method="post">
			<div class="col-lg-4">
				<?php 
				if ($this->session->flashdata('flash_message'))
				{
					?>
						<div class="alert alert-<?php echo $this->session->flashdata('flash_message')['status'] ?> alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<?php echo $this->session->flashdata('flash_message')['message'] ?>
						</div>
					<?php
				}
				?>
				<div class="form-group">
					<label>Email / Username</label>
					<input class="form-control" type="text" name="identity" placeholder="Email / Username" value="<?php echo set_value('identity') ?>">
					<?php echo form_error('identity', '<span class="help-block error">', '</span>'); ?>
				</div>
				<div class="form-group">
					<label>Password</label>
					<input class="form-control" type="password" name="password" placeholder="Password" value="<?php echo set_value('password') ?>">
					<?php echo form_error('password', '<span class="help-block error">', '</span>'); ?>
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-block btn-success">Masuk</button>
				</div>
				<div class="form-group">
					Belum punya akun? <a href="<?php echo base_url('site/mendaftar') ?>">Mendaftar</a>
				</div>
			</div>
		</form>
		<br>
	</div>
</div>