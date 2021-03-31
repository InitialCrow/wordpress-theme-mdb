<?php

/*
  Template Name: main
*/
global $wpdb;
$products = $wpdb->get_results( "SELECT *  FROM m_product ORDER BY name ASC" );

?>

<section id="order" class="main-section order border-title">
  <div class="wrap-title">
    <h2 class="news-title main-section-title" >Nos Produits</h2>
  </div>

  <div class="product-list">
  	<?php foreach($products as $p):?>
  		<div class="container">
        <input type="hidden" class="product_id" name="id" value="<?php echo $p->id ?>">
  			<img src="<?php echo $p->img?$p->img:get_template_directory_uri()."/assets/shopping.png" ?>" alt="image produit de la maison du boeuf" class="img-fruit" />
  			<h3><?php echo stripcslashes($p->name) ?></h3>
  			
  			<p class="scrollbar-1">
  				<?php echo stripcslashes($p->description) ?>
  			</p>
  			<div class="properties">
  				<div class="qty">
  					<h4>Quantité</h4>
  					<i class="fa fa-minus"></i>
  					<span class="number">1</span>
  					<i class="fa fa-plus"></i>
  				</div><div class="price">
  					<h4>Prix / kg</h4>
  					<span class="price-inr">
  						<span class="amount"><?php echo number_format($p->price, 2, ',', ' ')?></span>
  						<i class="fa fa-eur"></i>
  					</span>
  				</div><div class="delivery">
  					<h4>Livraison</h4>
  					<i class="fa fa-car"></i>
  					<span class="time">Vous serez averti par téléphone</span>
  				</div>
  			</div>
  			<input class="ip-add-cart" type="button" value="Ajouter à la commande" />
  		</div>
	<?php endforeach?>
	
  </div>
</section>