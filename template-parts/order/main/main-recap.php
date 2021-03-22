<?php

/*
  Template Name: recap
*/
global $wpdb;
$products = $wpdb->get_results( "SELECT *  FROM m_product" );

?>

<section id="recap" class="main-section recap">
  <div class="wrap-title hidden">
    <h2 class="news-title main-section-title" ><?php echo $blocks["commande titre 2"]["innerHTML"]; ?></h2>
  </div>
  <div class="details-modal-overlay"></div>
  <div class="wrap cf">
    
    <div class="heading cf">
      <h1>Ma Commande</h1>
      <a href="#" class="continue">Continuer</a>
    </div>
    <div class="cart">
      <ul class="cartWrap scrollbar-1">
        <!-- <li class="items odd">

          <div class="infoWrap"> 
            <div class="cartSection">
              <img src="http://lorempixel.com/output/technics-q-c-300-300-4.jpg" alt="" class="itemImg" />
            
              <h3>Item Name 1</h3>

              <p> <input type="text"  class="qty" placeholder="3"/> x 5.00 €</p>

              <p class="stockStatus"> En stock</p>
            </div>  


            <div class="prodTotal cartSection">
              <p>15.00 €</p>
            </div>
            <div class="cartSection removeWrap">
              <a href="#" class="remove">x</a>
            </div>
          </div>
        </li> -->



      </ul>
    </div>
    <form action="<?php echo plugins_url( 'wordpress-plugin-mdb-order/submit_order.php') ?>" class="order-form">
      
      <div class="promoCode">

        <small class="data-warning">* Aucune de ces données ne serons sauvegardées et donc utilisé a d'autre fin que de vous contacter pour la commande</small>
        <label for="name">Nom</label>
        <input type="text" name="name" placeholder="Entrer votre nom"  required/>
        <label for="mail">Email</label>
        <input type="email" name="mail" placeholder="Entrer votre email" required />
        <label for="phone">Téléphone</label>
        <input type="text" name="phone" placeholder="Entrer votre téléphone" required />


      </div>

      <div class="subtotal cf">
        <ul>
         <!--  <li class="totalRow"><span class="label">Subtotal</span><span class="value">0 €</span></li>

          <li class="totalRow"><span class="label">Shipping</span><span class="value"></span></li>

          <li class="totalRow"><span class="label">Tax</span><span class="value">$4.00</span></li> -->
          <li class="totalRow final"><span class="label">Total</span><span class="value">0 €</span></li>

          <li class="totalRow"><button  class="btn continue">Valider la commande</button></li>
        </ul>
      </div>
    </form>
  </div>


</section>