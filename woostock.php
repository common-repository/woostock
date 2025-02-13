<?php
global $woo_options;
?> 
<script type="text/javascript">
$(document).ready(function(){
   $('.topLink').click(function(){
      $("html, body").animate({scrollTop:"0px"});
    });
});
</script>
<head>   
	<style>
		table { border: 1px solid #0093bb; width: 100%; }
		table td, table th { border: 1px solid #0093bb; padding: 6px; }
        .topLink { border:solid 1px #39c; padding:4px 8px; border-radius:4px; margin:6px; box-shadow:0px 0px 3px #114857; }
	</style>
<style media="print">
  #inventory{ display: block !important; }
</style>
</head>
	                    

<section>
	<?php global $woocommerce; ?>

<script type="text/javascript">
 function printPage(){
        var tableData = '<table border="1">'+document.getElementsByTagName('table')[0].innerHTML+'</table>';
        var data = '<button onclick="window.print()"> Imprimir </button>'+tableData;       
        myWindow=window.open('','','width=800,height=800');
        myWindow.innerWidth = screen.width;
        myWindow.innerHeight = screen.height;
        myWindow.screenX = 0;
        myWindow.screenY = 0;
        myWindow.document.write(data);
        myWindow.focus();
    };
 </script>
	<br />
    <a href="javascript:void(0);" id="printPage"  onclick="printPage();">Imprimir</a>
    <br />
	<h2>Current Stock Report</h2>
	<table cellspacing="0" cellpadding="2" id="inventory">
		<thead>
			<tr>
				<th scope="col" style="text-align:left;"><?php _e('Product', 'woothemes'); ?></th>
				<th scope="col" style="text-align:left;"><?php _e('Color', 'woothemes'); ?></th>
				<th scope="col" style="text-align:left;"><?php _e('Actual Stock', 'woothemes'); ?></th>
			</tr>
		</thead>
		<tbody>
		<?php
		$args = array(
			'post_type'			=> 'product_variation',
			'post_status' 		=> 'publish',
	        'posts_per_page' 	=> -1,
	        'orderby'			=> 'title',
	        'order'				=> 'ASC',
			'meta_query' => array(
				array(
					'key' 		=> '_stock',
					'value' 	=> array('', false, null),
					'compare' 	=> 'NOT IN'
				)
			)
		);
		$loop = new WP_Query( $args );
		while ( $loop->have_posts() ) : $loop->the_post();
                        $product = new WC_Product_Variation( $loop->post->ID );	
			?>
			<tr>
				<td><?php echo $product->get_title(); ?></td>
				<td><?php echo $product->sku; ?></td>
				<td><?php echo $product->stock; ?></td>
			</tr>
			<?php
		endwhile; 
		?>
		</tbody>
	</table>
    <br />
    <br />
    <a class="topLink" href="#">Subir</a>