<?php
$foto = $this->foto_katalog_model->get_where(array('id_katalog' => $katalog['id']));
$foto_data = array();

foreach ($foto as $key => $value) {
	$foto_data['item_'.$key] = array(
		'orig' => base_url('uploads/katalog_produk/'.$value['foto']),
		'main' => base_url('uploads/katalog_produk/'.$value['foto']),
		'thumb' => base_url('uploads/katalog_produk/'.$value['foto']),
		'label' => ''
	);
}

$json = array(
	'prod_1' => array(
		'main' => array(
			'orig' => base_url('uploads/katalog_produk/'.$foto[0]['foto']),
			'main' => base_url('uploads/katalog_produk/'.$foto[0]['foto']),
			'thumb' => base_url('uploads/katalog_produk/'.$foto[0]['foto']),
			'label' => ''
		),
		'gallery' => $foto_data,
		'type' => 'simple',
		'video' => 'false'
	)
);
?>

<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/aditii-w3layout/') ?>css/productviewgallery.css" media="all" />
<script type="text/javascript" src="<?php echo base_url('assets/aditii-w3layout/') ?>js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('assets/aditii-w3layout/') ?>js/cloud-zoom.1.0.3.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('assets/aditii-w3layout/') ?>js/jquery.fancybox.pack.js"></script>
<script type="text/javascript" src="<?php echo base_url('assets/aditii-w3layout/') ?>js/jquery.fancybox-buttons.js"></script>
<script type="text/javascript" src="<?php echo base_url('assets/aditii-w3layout/') ?>js/jquery.fancybox-thumbs.js"></script>
<script type="text/javascript" src="<?php echo base_url('assets/aditii-w3layout/') ?>js/productviewgallery.js"></script>
<!-- start top_js_button -->
<script type="text/javascript" src="<?php echo base_url('assets/aditii-w3layout/') ?>js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('assets/aditii-w3layout/') ?>js/move-top.js"></script>
<script type="text/javascript" src="<?php echo base_url('assets/aditii-w3layout/') ?>js/easing.js"></script>
<div class="single">
<!-- start span1_of_1 -->
<div class="left_content">
	<div class="span1_of_1">
		<!-- start product_slider -->
		<div class="product-view">
			<div class="product-essential">
				<div class="product-img-box">
					<div class="more-views" style="float:left;">
						<div class="more-views-container">
							<ul>
								<li>
									<a class="cs-fancybox-thumbs" data-fancybox-group="thumb" style="width:64px;height:85px;" href=""  title="" alt="">
									<img src="" src_main=""  title="" alt="" /></a>            
								</li>
								<li>
									<a class="cs-fancybox-thumbs" data-fancybox-group="thumb" style="width:64px;height:85px;" href=""  title="" alt="">
									<img src="" src_main=""  title="" alt="" /></a>
								</li>
								<li>
									<a class="cs-fancybox-thumbs" data-fancybox-group="thumb" style="width:64px;height:85px;" href=""  title="" alt="">
									<img src="" src_main=""  title="" alt="" /></a> 
								</li>
								<li>
									<a class="cs-fancybox-thumbs" data-fancybox-group="thumb" style="width:64px;height:85px;" href=""  title="" alt="">
									<img src="" src_main="" title="" alt="" /></a>  
								</li>
								<li>
									<a class="cs-fancybox-thumbs" data-fancybox-group="thumb" style="width:64px;height:85px;" href=""  title="" alt="">
									<img src="" src_main="" title="" alt="" /></a>
								</li>
							</ul>
						</div>
					</div>
					<div class="product-image"> 
						<a class="cs-fancybox-thumbs cloud-zoom" rel="adjustX:30,adjustY:0,position:'right',tint:'#202020',tintOpacity:0.5,smoothMove:2,showTitle:true,titleOpacity:0.5" data-fancybox-group="thumb" href="<?php echo base_url('uploads/katalog_produk/'.$foto[0]['foto']) ?>" title="Women Shorts" alt="Women Shorts">
						<img src="<?php echo base_url('uploads/katalog_produk/'.$foto[0]['foto']) ?>" alt="Women Shorts" title="Women Shorts" />
						</a>
					</div>
					<script type="text/javascript">
						var prodGallery = jQblvg.parseJSON('<?php echo json_encode($json) ?>'),
							gallery_elmnt = jQblvg('.product-img-box'),
							galleryObj = new Object(),
							gallery_conf = new Object();
							gallery_conf.moreviewitem = '<a class="cs-fancybox-thumbs" data-fancybox-group="thumb" style="width:64px;height:85px;" href=""  title="" alt=""><img src="" src_main="" width="64" height="85" title="" alt="" /></a>';
							gallery_conf.animspeed = 200;
						jQblvg(document).ready(function() {
							galleryObj[1] = new prodViewGalleryForm(prodGallery, 'prod_1', gallery_elmnt, gallery_conf, '.product-image', '.more-views', 'http:');
									jQblvg('.product-image .cs-fancybox-thumbs').absoluteClick();
							jQblvg('.cs-fancybox-thumbs').fancybox({ prevEffect : 'none', 
																nextEffect : 'none',
																closeBtn : true,
																arrows : true,
																nextClick : true, 
																helpers: {
																thumbs : {
																		width: 64,
																		height: 85,
																		position: 'bottom'
																}
																}
																});
							jQblvg('#wrap').css('z-index', '100');
										jQblvg('.more-views-container').elScroll({type: 'vertical', elqty: 4, btn_pos: 'border', scroll_speed: 400 });
						        
						});
						
						function initGallery(a,b,element) {
							galleryObj[a] = new prodViewGalleryForm(prods, b, gallery_elmnt, gallery_conf, '.product-image', '.more-views', '');
						};
					</script>
				</div>
			</div>
		</div>
		<!-- end product_slider -->
	</div>
	<!-- start span1_of_1 -->
	<div class="span1_of_1_des">
		<div class="desc1">
			<h3><?php echo $katalog['nama']; ?></h3>
			<p><?php echo $katalog['deskripsi']; ?></p>
			<div class="available">
				<div class="btn_form">
					<form action="<?php echo base_url('site/order_from_katalog') ?>" method="post">
						<?php foreach ($foto as $value) : ?>
							<input type="hidden" name="desain[]" value="<?php echo 'uploads/katalog_produk/'.$value['foto'] ?>">
						<?php endforeach; ?>
						<input type="submit" value="Pilih" title="" />
					</form>
				</div>
				<div class="clear"></div>
			</div>
		</div>
	</div>
	<div class="clear"></div>
	<!-- end tabs -->
</div>
<!-- end sidebar -->
<div class="clear"></div>
</div