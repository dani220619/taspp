<div class="row">
	<div class="col-lg-12">
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
	</div>
	<div class="col-lg-12">
		<form action="<?php echo CURRENT_URL ?>" method="post">
			<div class="col-lg-4">
				<div class="form-group">
					<label>Nama Lengkap</label>
					<input class="form-control" type="text" name="nama_lengkap" placeholder="Nama Lengkap" value="<?php echo set_value('nama_lengkap') ?>">
					<?php echo form_error('nama_lengkap', '<span class="help-block error">', '</span>'); ?>
				</div>
				<div class="form-group">
					<label>Email</label>
					<input class="form-control" type="text" name="email" placeholder="Email" value="<?php echo set_value('email') ?>">
					<?php echo form_error('email', '<span class="help-block error">', '</span>'); ?>
				</div>
				<div class="form-group">
					<label>Seluler</label>
					<input class="form-control" type="text" name="seluler" placeholder="Seluler" value="<?php echo set_value('seluler') ?>">
					<?php echo form_error('seluler', '<span class="help-block error">', '</span>'); ?>
				</div>
				<div class="form-group">
					<label>Username</label>
					<input class="form-control" type="text" name="username" placeholder="Username" value="<?php echo set_value('username') ?>">
					<?php echo form_error('username', '<span class="help-block error">', '</span>'); ?>
				</div>
				<div class="form-group">
					<label>Password</label>
					<input class="form-control" type="password" name="password" placeholder="Password" value="<?php echo set_value('password') ?>">
					<?php echo form_error('password', '<span class="help-block error">', '</span>'); ?>
				</div>
				<div class="form-group">
					<label>Alamat</label>
					<textarea class="form-control" placeholder="Alamat" name="alamat"></textarea>
					<?php echo form_error('alamat', '<span class="help-block error">', '</span>'); ?>
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-block btn-success">Masuk</button>
				</div>
			</div>
		</form>
	</div>
</div>