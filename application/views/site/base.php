<!DOCTYPE HTML>
<html>
	<head>
		<title><?php echo (isset($page_title))?APP_INFO['name'].' - '.$page_title:APP_INFO['name']; ?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-t6ZRlJ6ooe-W2ZC1"></script>
		<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700' rel='stylesheet' type='text/css'>
		<link href="<?php echo base_url('assets/aditii-w3layout/') ?>css/style.css" rel="stylesheet" type="text/css" media="all" />
		<link href="<?php echo base_url('assets/aditii-w3layout/') ?>css/chat.css" rel="stylesheet" type="text/css" media="all" />
		<link href="<?php echo base_url('assets/aditii-w3layout/') ?>css/slider.css" rel="stylesheet" type="text/css" media="all" />
		<link href="<?php echo base_url('assets/bootstrap-3.4.1/css/bootstrap.min.css') ?>" rel="stylesheet" type="text/css">
		<link href="<?php echo base_url('assets/adminlte-2.4.8/bower_components/font-awesome/css/font-awesome.min.css') ?>" rel="stylesheet" type="text/css">
		<style type="text/css">
		.help-block.error {
			color: red;
		}
		</style>
		<script type="text/javascript" src="<?php echo base_url('assets/bootstrap-3.4.1/js/jquery-3.5.1.min.js') ?>"></script>
		<script type="text/javascript" src="<?php echo base_url('assets/bootstrap-3.4.1/js/bootstrap.min.js') ?>"></script>
		<script type="text/javascript" src="<?php echo base_url('assets/aditii-w3layout/') ?>js/modernizr.custom.28468.js"></script>
		<script type="text/javascript" src="<?php echo base_url('assets/aditii-w3layout/') ?>js/jquery.cslider.js"></script>
		<script type="text/javascript" src="<?php echo $this->config->item('socketio_host').':'.$this->config->item('socketio_port'); ?>/socket.io/socket.io.js"></script>
		<?php if ($this->router->fetch_method() == 'index') : ?>
		<script type="text/javascript">
		$(function() {
			$('#da-slider').cslider();
		});
		</script>
		<!-- Owl Carousel Assets -->
		<link href="<?php echo base_url('assets/aditii-w3layout/') ?>css/owl.carousel.css" rel="stylesheet">
		<!-- Owl Carousel Assets -->
		<!-- Prettify -->
		<script src="<?php echo base_url('assets/aditii-w3layout/') ?>js/owl.carousel.js"></script>
		<script>
		$(document).ready(function() {
			$("#owl-demo").owlCarousel({
				items : 4,
				lazyLoad : true,
				autoPlay : true,
				navigation : true,
				navigationText : ["",""],
				rewindNav : false,
				scrollPerPage : false,
				pagination : false,
				paginationNumbers: false
			});
		});
		</script>
		<?php endif; ?>
		<!-- //Owl Carousel Assets -->
		<!-- start top_js_button -->
		<script type="text/javascript" src="<?php echo base_url('assets/aditii-w3layout/') ?>js/move-top.js"></script>
		<script type="text/javascript" src="<?php echo base_url('assets/aditii-w3layout/') ?>js/easing.js"></script>
		<script type="text/javascript">
			jQuery(document).ready(function($) {
				$(".scroll").click(function(event){		
					event.preventDefault();
					$('html,body').animate({scrollTop:$(this.hash).offset().top},1200);
				});
			});
		</script>
	</head>
	<body>
		<!-- start header -->
		<div class="header_bg">
			<div class="wrap">
				<div class="header">
					<div class="logo">
						<a href="<?php echo base_url('site') ?>"><h2><?php echo APP_INFO['name']; ?></h2></a>
					</div>
					<div class="h_icon">
						<ul class="icon1 sub-icon1">
							<li>
								<a class="active-icon c1" href="<?php echo base_url('site/pesan') ?>"><i>Rp.<?php echo number_format($this->cart->total(), 0, ',', '.'); ?></i></a>
							</li>
						</ul>
					</div>
					<div class="clear"></div>
				</div>
			</div>
		</div>
		<div class="header_btm">
			<div class="wrap">
				<div class="header_sub">
					<div class="h_menu">
						<ul>
							<li class="<?php echo $this->router->fetch_method() == 'index'?'active':'' ?>"><a href="<?php echo base_url('site') ?>">Beranda</a></li>
							|
							<li class="<?php echo $this->router->fetch_method() == 'pesan'?'active':'' ?>"><a href="<?php echo base_url('site/pesan') ?>">Pesan</a></li>
							<?php if (!empty($this->session->userdata('pengguna'))) : ?>
								|
								<li class="<?php echo $this->router->fetch_method() == 'akun'?'active':'' ?>"><a href="<?php echo base_url('site/akun') ?>">Akun</a></li>
								|
								<li class="<?php echo $this->router->fetch_method() == 'tagihan'?'active':'' ?>"><a href="<?php echo base_url('site/tagihan') ?>">Transaksi</a></li>
							<?php else: ?>
								|
								<li class="<?php echo $this->router->fetch_method() == 'masuk'?'active':'' ?>"><a href="<?php echo base_url('site/masuk') ?>">Masuk</a></li>
							<?php endif ?>
						</ul>
					</div>
					<div class="top-nav">
						<nav class="nav">
							<a href="#" id="w3-menu-trigger"> </a>
							<ul class="nav-list" style="">
								<li class="nav-item"><a class="<?php echo $this->router->fetch_method() == 'index'?'active':'' ?>" href="<?php echo base_url('site') ?>">Beranda</a></li>
								<li class="nav-item"><a class="<?php echo $this->router->fetch_method() == 'pesan'?'active':'' ?>" href="<?php echo base_url('site/pesan') ?>">Pesan</a></li>
								<li class="nav-item"><a class="<?php echo $this->router->fetch_method() == 'masuk'?'active':'' ?>" href="<?php echo base_url('site/masuk') ?>">Masuk</a></li>
							</ul>
						</nav>
						<div class="search_box">
							<form>
								<input type="text" value="Search" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search';}"><input type="submit" value="">
							</form>
						</div>
						<div class="clear"> </div>
						<script src="<?php echo base_url('assets/aditii-w3layout/') ?>js/responsive.menu.js"></script>
					</div>
					<div class="clear"></div>
				</div>
			</div>
		</div>
		<!-- start slider -->
		
		<?php if ($this->router->fetch_method() == 'index') : ?>
		<div id="da-slider" class="da-slider">
			<?php foreach ($this->web_slider_model->list() as $key => $value): ?>
			<div class="da-slide">
				<h2><?php echo $value['judul']; ?></h2>
				<p><?php echo $value['konten']; ?></p>
				<a href="<?php echo $value['tombol_link']; ?>" class="da-link"><?php echo $value['tombol_teks']; ?></a>
				<div class="da-img"><img src="<?php echo base_url($value['image']) ?>" alt="image01" /></div>
			</div>
			<?php endforeach; ?>
			<nav class="da-arrows">
				<span class="da-arrows-prev"></span>
				<span class="da-arrows-next"></span>
			</nav>
		</div>
		<?php endif ?>

		<!-- start main -->
		<div class="main_bg">
			<div class="wrap">
				<div class="main">
					<?php echo $page ?>
				</div>
			</div>
		</div>
		<!-- start footer -->
		<div class="footer_bg">
			<div class="wrap">
				<div class="footer">
					<!-- start grids_of_4 -->	
					<div class="grids_of_4">
						<div class="grid1_of_4">
							<h4>Katalog</h4>
							<ul class="f_nav">
								<li><a href="">alexis Hudson</a></li>
								<li><a href="">american apparel</a></li>
								<li><a href="">ben sherman</a></li>
								<li><a href="">big buddha</a></li>
								<li><a href="">channel</a></li>
								<li><a href="">christian audigier</a></li>
								<li><a href="">coach</a></li>
								<li><a href="">cole haan</a></li>
							</ul>
						</div>
						<div class="grid1_of_4">
							<h4>Informasi</h4>
							<ul class="f_nav">
								<li><a href="">alexis Hudson</a></li>
								<li><a href="">american apparel</a></li>
								<li><a href="">ben sherman</a></li>
								<li><a href="">big buddha</a></li>
								<li><a href="">channel</a></li>
								<li><a href="">christian audigier</a></li>
								<li><a href="">coach</a></li>
								<li><a href="">cole haan</a></li>
							</ul>
						</div>
						<div class="grid1_of_4">
							<h4>Kontak</h4>
							<ul class="f_nav">
								<li><a href="mailto:cs@tailor.com">customer_service@tailor.com</a></li>
								<li><a href=""><i class="fa fa-whatsapp"></i> (+62) 0821-6736-8585</a></li>
								<li><a href="">Jl.Sudirman, no.13</a></li>
							</ul>
						</div>
						<div class="grid1_of_4">
							<h4>Sosial Media</h4>
							<ul class="f_nav">
								<li><a href="https://facebook.com"><i class="fa fa-facebook"></i></a></li>
								<li><a href="https://twitter.com"><i class="fa fa-twitter"></i></a></li>
								<li><a href="https://instagram.com"><i class="fa fa-instagram"></i></a></li>
							</ul>
						</div>
						<div class="clear"></div>
					</div>
				</div>
			</div>
		</div>
		<!-- start footer -->
		<div class="footer_bg1">
			<div class="wrap">
				<div class="footer">
					<!-- scroll_top_btn -->
					<script type="text/javascript">
						$(document).ready(function() {
							var defaults = {
								containerID: 'toTop', // fading element id
								containerHoverID: 'toTopHover', // fading element hover id
								scrollSpeed: 1200,
								easingType: 'linear' 
							};
							$().UItoTop({ easingType: 'easeOutQuart' });
						});
					</script>
					<a href="#" id="toTop" style="display: block;"><span id="toTopHover" style="opacity: 1;"></span></a>
					<!--end scroll_top_btn -->
					<div class="copy">
						<p class="link">&copy;  All rights reserved | <?php echo APP_INFO['name'] ?></p>
					</div>
					<div class="clear"></div>
				</div>
			</div>
		</div>
		<div class="chatbox chatbox--tray chatbox--empty">
			<div class="chatbox__title">
				<h5><a href="#">Customer Service</a></h5>
				<button class="chatbox__title__tray"><span></span></button>
				<button class="chatbox__title__close">
					<span>
						<svg viewBox="0 0 12 12" width="12px" height="12px">
							<line stroke="#FFFFFF" x1="11.75" y1="0.25" x2="0.25" y2="11.75"></line>
							<line stroke="#FFFFFF" x1="11.75" y1="11.75" x2="0.25" y2="0.25"></line>
						</svg>
					</span>
				</button>
			</div>
			<div class="chatbox__body"></div>
			<form class="chatbox__credentials">
				<div class="form-group">
					<label for="chatLoginFullName">Name:</label>
					<input type="text" class="form-control" id="chatLoginFullName">
				</div>
				<div class="form-group">
					<label for="chatLoginEmail">Email:</label>
					<input type="email" class="form-control" id="chatLoginEmail">
				</div>
				<button type="submit" class="btn btn-success btn-block">Enter Chat</button>
			</form>
			<!-- <textarea class="chatbox__message" placeholder="Write something interesting"></textarea> -->
			<input type="text" class="chatbox__message" placeholder="Tuliskan sesuatu">
		</div>
		</body>
		<script type="text/javascript">
			var user_session = <?php echo (!empty(aktif_sesi()))?json_encode(array(
				'id' => aktif_sesi()['id'],
				'email' => aktif_sesi()['email'],
				'nama_lengkap' => aktif_sesi()['nama_lengkap']
			)):'{}'; ?>;

			var guest = JSON.parse(localStorage.getItem('guest'));
			var chat_room = JSON.parse(localStorage.getItem('chat_room'));

			const socket = io('<?php echo $this->config->item('socketio_host').':'.$this->config->item('socketio_port'); ?>');

			var $chatbox = $('.chatbox'),
						$chatboxTitle = $('.chatbox__title'),
						$chatboxTitleClose = $('.chatbox__title__close'),
						$chatboxCredentials = $('.chatbox__credentials'),
						$chatboxBody = $('.chatbox__body'),
						$chatboxMessage = $('.chatbox__message');

			function update_chat_room(room_id, data) {
				$.ajax({
					url: '<?php echo base_url('chat/update_chat_room/') ?>'+room_id,
					type: 'POST',
					dataType: 'JSON',
					data: data,
					success: function(data) {
						console.log(data)
					},
					error: function(error) {
						console.log(error)
					}
				});
			}

			$chatboxCredentials.on('submit', function(e) {
				e.preventDefault();
				$chatbox.removeClass('chatbox--empty');
				$.ajax({
					url: '<?php echo base_url('chat/create_room') ?>',
					type: 'POST',
					dataType: 'JSON',
					data: {
						full_name: $('#chatLoginFullName').val(),
						email: $('#chatLoginEmail').val()
					},
					success: function(data) {
						console.log(data)
						if (data.status == 'success') {
							localStorage.setItem('guest', JSON.stringify({
								full_name: $('#chatLoginFullName').val(),
								email: $('#chatLoginEmail').val()
							}))
							join_chat_room({
								id: data.data.id,
								status: data.data.status
							});
						}
					},
					error: function(error) {
						console.log(error)
					}
				});
			});

			(function($) {
				$(document).ready(function() {
					$chatboxTitle.on('click', function() {
						$chatbox.toggleClass('chatbox--tray');
					});

					$chatboxTitleClose.on('click', function(e) {
						e.stopPropagation();
						$chatbox.addClass('chatbox--closed');

						var chat_room = JSON.parse(localStorage.getItem('chat_room'));

						if (chat_room !== null) {
							update_chat_room(chat_room.id, {
								status: 'selesai'
							});
							socket.emit('close_chat_room', chat_room.id);
							localStorage.removeItem('chat_room');
							localStorage.removeItem('guest');
						}
					});

					$chatbox.on('transitionend', function() {
						if ($chatbox.hasClass('chatbox--closed')) $chatbox.remove();
					});
			    });
			})(jQuery);

			function get_chat_messages(room_id, limit = 10, offset = 0, desc = false) {
				$.ajax({
					url: '<?php echo base_url('chat/messages/'); ?>'+room_id+'/'+limit+'/'+offset+'/'+desc,
					type: 'GET',
					dataType: 'JSON',
					success: function(data) {
						if (data.status == 'success') {
							$.each(data.data.messages, function(index, el) {
								if (el.by == 'customer') {
									$chatboxBody.append(
										'<div class="chatbox__body__message chatbox__body__message--right">'+
											'<img src="<?php echo base_url('assets/adminlte-2.4.8/dist/img/') ?>/user8-128x128.jpg" alt="Picture">'+
											'<p>'+el.text+'</p>'+
										'</div>'
									);
								} else {
									$chatboxBody.append(
										'<div class="chatbox__body__message chatbox__body__message--left">'+
											'<img src="<?php echo base_url('assets/adminlte-2.4.8/dist/img/') ?>/user1-128x128.jpg" alt="Picture">'+
											'<p>'+el.text+'</p>'+
										'</div>'
									);
								}
							});

							var direct_chat_message = $('.chatbox__body');
							direct_chat_message[0].scrollTop = direct_chat_message[0].scrollHeight;
						}
					},
					error: function(error) {

					}
				});
			}

			function chat_room_info(room_id) {
				$.ajax({
					url: '<?php echo base_url('chat/room_info/') ?>'+room_id,
					type: 'GET',
					dataType: 'JSON',
					success: function(chat_room) {
						if (chat_room.status == 'success') {
							if (chat_room.data.status == 'selesai') {
								$chatbox.addclass('chatbox--tray chatbox--empty');
								localStorage.removeItem('chat_room');
							} else {
								if (Object.keys(user_session).length > 0) {
									// var room = JSON.parse(localStorage.getItem('chat_room'));
									// if (room.customer == null) {
									// 	localStorage.removeItem('chat_room');
									// 	window.location.reload();
									// }
								}
								else {
									$chatbox.removeClass('chatbox--tray chatbox--empty');
									join_chat_room(chat_room.data);
								}
							}
						}
					},
					error: function(error) {
						console.log(error)
					}
				});
			}

			function join_chat_room(chat_room) {
				localStorage.setItem('chat_room', JSON.stringify(chat_room));
				$chatbox.removeClass('chatbox--empty');
				$chatboxMessage.focus();
				socket.emit('join_chat_room', chat_room.id);
			}

			$(document).ready(function() {

				var chat_room = JSON.parse(localStorage.getItem('chat_room'));
				if (chat_room !== null && Object.keys(user_session).length > 0) {
					chat_room_info(chat_room.id);
				} else if (chat_room !== null && guest !== null) {
					chat_room_info(chat_room.id);
				}

				if (chat_room !== null) {
					get_chat_messages(chat_room.id, 1000, 0);
				} else {
					if (Object.keys(user_session).length > 0) {
						$.ajax({
							url: '<?php echo base_url('chat/create_room') ?>',
							type: 'POST',
							dataType: 'JSON',
							success: function(data) {
								if (data.status == 'success') {
									join_chat_room({
										id: data.data.id,
										status: data.data.status
									});
								}
							},
							error: function(error) {
								console.log(error)
							}
						});
					}
				}

				$chatboxMessage.keypress(function(event) { 
					if (event.keyCode === 13) { 
						var chat_room = JSON.parse(localStorage.getItem('chat_room'));
						var message = $chatboxMessage.val();

						if (message !== '') {
							$.ajax({
								url: '<?php echo base_url('chat/send_message/') ?>'+chat_room.id,
								type: 'POST',
								dataType: 'JSON',
								data: {
									from: 'customer',
									message: message
								},
								success: function(data) {
									if (data.status == 'success') {
										socket.emit('message_chat_room', {
											chat_room: chat_room,
											from: 'customer',
											message: message
										});

										$chatboxBody.append(
											'<div class="chatbox__body__message chatbox__body__message--right">'+
												'<img src="<?php echo base_url('assets/adminlte-2.4.8/dist/img/') ?>/user8-128x128.jpg" alt="Picture">'+
												'<p>'+data.data.message+'</p>'+
											'</div>'
										);
									}
								},
								error: function(error) {
									console.log(error)
								}
							});

							$chatboxMessage.val('');
						}
					}
				});

				$chatboxTitle.on('click', function() {

					guest = JSON.parse(localStorage.getItem('guest'));
					chat_room = JSON.parse(localStorage.getItem('chat_room'));

					if (chat_room == null) {
						$('.chatbox').addClass('chatbox--empty');
					}
					else
					{
						if ($chatbox.hasClass('chatbox--tray') === false) {

							if (chat_room !== null) {
								$chatbox.removeClass('chatbox--empty');
								$chatboxMessage.focus();
								
								var direct_chat_message = $('.chatbox__body');
								direct_chat_message[0].scrollTop = direct_chat_message[0].scrollHeight;
								socket.emit('join_chat_room', chat_room.id);
							}

							if (chat_room === null) {
								if (Object.keys(user_session).length > 0) {
									$.ajax({
										url: '<?php echo base_url('chat/create_room') ?>',
										type: 'POST',
										dataType: 'JSON',
										success: function(data) {
											if (data.status == 'success') {
												join_chat_room({
													id: data.data.id,
													status: data.data.status
												});
											}
										},
										error: function(error) {
											console.log(error)
										}
									});
								} else if (guest !== null) {
									$.ajax({
										url: '<?php echo base_url('chat/create_room') ?>',
										type: 'POST',
										dataType: 'JSON',
										data: {
											full_name: guest.full_name,
											email: guest.email
										},
										success: function(data) {
											if (data.status == 'success') {
												join_chat_room({
													id: data.data.id,
													status: data.data.status
												})
											}
										},
										error: function(error) {
											console.log(error)
										}
									});
								}
							}
						} else {
							console.log('ada')
						}
					}
				});

				socket.on('message_chat_room', data => {
					if (data.from == 'admin') {
						$chatboxBody.append(
							'<div class="chatbox__body__message chatbox__body__message--left">'+
								'<img src="<?php echo base_url('assets/adminlte-2.4.8/dist/img/') ?>/user1-128x128.jpg" alt="Picture">'+
								'<p>'+data.message+'</p>'+
							'</div>'
						);
					}

					var direct_chat_message = $('.chatbox__body');
					direct_chat_message[0].scrollTop = direct_chat_message[0].scrollHeight;
				});

				socket.on('admin_joined_room', data => {
					var chat_room = JSON.parse(localStorage.getItem('chat_room'));
					if (chat_room.id == data) {
						chat_room.status = 'berlangsung';
					}

					localStorage.setItem('chat_room', JSON.stringify(chat_room));
				});

				socket.on('close_chat_room', data => {
					localStorage.removeItem('chat_room');
					window.location.reload();
				});

				socket.on('disconnect', () => {
					// $('.chatbox__title h5').css({
					// 	'background':'red'
					// });
				});
			});
		</script>
	</body>
</html>