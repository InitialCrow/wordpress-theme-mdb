(function ($, ctx){

 var app = {

  init : function(){
    $(document).ready(function(){
      $("#gallery").unitegallery({
        tiles_type:"justified"
      });
      app.initSlide()
      //app.like(".clickable-like", ".publish-func-list")
      app.initScrollAnim(".animA")
      app.changeProductQty()
      app.initOrder()
      app.initCart()
      app.removeItemCart()
      app.postOrder()
      app.updateItemCart()
      
    })
  },
  postOrder:function(){
    $('.order-form').on('submit',function(evt){
      evt.preventDefault()
      var formatedData = new FormData($('.order-form')[0])
      formatedData.append("cart",sessionStorage.getItem("cart"))
      $.ajax({
        type: "POST",
        url: $(this).attr('action'),
        data: formatedData,
        dataType:"JSON",
        cache: false,
        contentType: false,
        processData: false,
        success: function(data, http){
          var title = data.status?"Merci pour votre commande":"Une erreur est survenue"

          $(".details-modal-overlay").css('opacity',1)
          $(".recap").append('<div class="details-modal"><div class="details-modal-close"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none"><path fill-rule="evenodd" clip-rule="evenodd" d="M13.7071 1.70711C14.0976 1.31658 14.0976 0.683417 13.7071 0.292893C13.3166 -0.0976311 12.6834 -0.0976311 12.2929 0.292893L7 5.58579L1.70711 0.292893C1.31658 -0.0976311 0.683417 -0.0976311 0.292893 0.292893C-0.0976311 0.683417 -0.0976311 1.31658 0.292893 1.70711L5.58579 7L0.292893 12.2929C-0.0976311 12.6834 -0.0976311 13.3166 0.292893 13.7071C0.683417 14.0976 1.31658 14.0976 1.70711 13.7071L7 8.41421L12.2929 13.7071C12.6834 14.0976 13.3166 14.0976 13.7071 13.7071C14.0976 13.3166 14.0976 12.6834 13.7071 12.2929L8.41421 7L13.7071 1.70711Z" fill="black" /></svg></div><div class="details-modal-title"><h1>'+title+'</h1></div><div class="details-modal-content"><p>'+data.msg+'</p></div></div>')
          
          $('.details-modal-close').on('click',function(){
            
            $(".details-modal-overlay").css('opacity',0)
            $('.details-modal-close').off('click')
            $(".details-modal").remove()
            

              sessionStorage.removeItem("cart")
              app.refreshCart()
          
          })
        },
      });

    })
  },
  changeProductQty:function(){
    

    $(".fa-plus").on("click",function(evt){
      $card = $(evt.target.offsetParent)
      var price = $card.find(".amount").text().replace(",",".")
      if($card[0].base_price == undefined){
        $card[0].base_price = price
      }

    
      var _num = parseInt($card.find(".number").text()) + 1;
    
      $card.find(".number").text(_num);
      $card.find(".amount").text((_num*$card[0].base_price).toFixed(2).replace(".",","));
    });

    $(".fa-minus").on("click",function(evt){
      $card = $(evt.target.offsetParent)
      var price = $card[0].base_price
      var _num = parseInt($card.find(".number").text()) - 1;
      
      if(_num > 0){

        $card.find(".number").text(_num);
     
        $card.find(".amount").text((_num*price).toFixed(2).replace(".",","));
      }
    });
  },
  initCart:function(){

    var cart = JSON.parse(sessionStorage.getItem('cart'))||{}

    var $wrapp = $('.cartWrap')
    var tog = 0
    var banner = "odd"
    var total = 0;
    $wrapp.empty()
    var keys = Object.keys(cart)
    for(var i =0; i<keys.length; i++){
      var k = keys[i]
   
      total+=parseFloat(cart[k].price)
      if(tog == 0 ){
        banner = "odd"
        tog=1
      
      }
      else{
        banner = "even"
        tog = 0
      }

      $wrapp.append('<li class="items '+banner+'"><div class="infoWrap"><div class="cartSection"><img src="'+cart[k].img+'" alt="" class="itemImg" /><h3>'+cart[k].name+'</h3><p> <input type="text"  class="qty qty-c" placeholder="'+cart[k].qty+'"/> x '+cart[k].base_price.toString().replace(".",",")+' €</p><p class="stockStatus"> En stock</p></div><div class="prodTotal cartSection"><p>'+cart[k].price.toString().replace('.',',')+' €</p></div><div class="cartSection removeWrap"><a href="#" class="remove">x</a></div></div><input type="hidden" class="product_id" value="'+cart[k].id+'"></li>')
    }
    $(".final .value").text((total.toFixed(2)+" €").replace('.',','))
    app.removeItemCart()
    app.updateItemCart()
  },
  removeItemCart :function(){
    $('a.remove').off()
    $('a.remove').on('click',function(evt){
      evt.preventDefault();
      var cart = JSON.parse(sessionStorage.getItem('cart'))||{}
      var $product =  $(this).parent().parent().parent()

      $product.hide( 400 );
      var id= $product.find('.product_id').val()
      
      delete cart["p_"+id]
      
      sessionStorage.setItem('cart',JSON.stringify(cart))
     
    })
  },
  updateItemCart :function(){
    $('.qty-c').off()
    $('.qty-c').on('blur',function(evt){
      evt.preventDefault();
      if(evt.target.value ==""){
        return
      }

      var cart = JSON.parse(sessionStorage.getItem('cart'))||{}
      var $product =  $(this).parent().parent().parent().parent()
    
      var id= $product.find('.product_id').val()
      
      cart["p_"+id].qty = parseInt(evt.target.value)
      cart["p_"+id].price = (parseFloat(cart["p_"+id].base_price)*cart["p_"+id].qty).toFixed(2)
      sessionStorage.setItem('cart',JSON.stringify(cart))
      app.initCart()
    })
  },
  refreshCart : function(){

    app.initCart()
  },
  initOrder: function(){
    var cart = {}
    
   
    $('.ip-add-cart').on('click',function(evt){
      if(sessionStorage.getItem('cart')){
        cart = JSON.parse(sessionStorage.getItem('cart'))
      }
      else{
        cart = {}
      }
      var $card = $(evt.target.offsetParent)
      var price = $(evt.target.offsetParent).find(".amount").text().replace(',',".")
      var name = $(evt.target.offsetParent).find("h3").text()
      var img = $(evt.target.offsetParent).find(".img-fruit").attr("src")
      var qty = $(evt.target.offsetParent).find(".number").text()
      var id = $(evt.target.offsetParent).find(".product_id").val()
      
      var product = {}
      product= {
        id:id,
        price : parseFloat(price),
        name :name,
        img : img,
        qty :parseInt(qty),
        base_price : (price/qty).toFixed(2)
      }
      if(cart["p_"+id] !== undefined){
     
        cart["p_"+id].price = parseFloat(cart["p_"+id].price)
        cart["p_"+id].price += product.price
        cart["p_"+id].qty += product.qty
        cart["p_"+id].price = cart["p_"+id].price.toFixed(2)
     

      }
      else{
        cart["p_"+id]=product

      }
    
      sessionStorage.setItem('cart', JSON.stringify(cart));
      app.refreshCart()
    
      
    })
  },
  initScrollAnim : function(classN){
    $(classN).on('click', function(evt){
     var target = $(this).attr('href');
     if(target[0]!=="#"){
      return
     }
     // bloquer le comportement par défaut: on ne rechargera pas la page
     evt.preventDefault();
     // enregistre la valeur de l'attribut  href dans la variable target

     /* le sélecteur $(html, body) permet de corriger un bug sur chrome
     et safari (webkit) */
     $('html, body')
     // on arrête toutes les animations en cours
     .stop()
     /* on fait maintenant l'animation vers le haut (scrollTop) vers
      notre ancre target */
     .animate({scrollTop: $(target).offset().top}, 1000 );
    });
  },
  like : function(classN, class2){
    var $datas = $(class2)
    var datas = []
    for(var i=0; i<$datas.length; i++){
      datas.push($datas[i].dataset.postId)
    }
    $(document).on('click',classN,function(evt){
      var index = $(this).parent().parent().parent().index()
      var data = datas[index]
      var isLike = $(this).attr('data-like')
      var nb = parseInt($(this).html())

      var formatedData = {data : data, isLike : isLike}
      $self = $(this)
      $.ajax({
        type: "POST",
        data : {'like':formatedData},
        url: postHandling.postUrl,
        dataType: "html",
        success: function(p1,p2){
          nb +=1
          $self.html(nb)
          $self.parent().children().removeClass("clickable-like")
          $self.parent().children().addClass("unclickable")

        },
        error : function(result, status, error){
              console.log(error)
        }

      });

    })
  },
  initSlide : function(){
    app.slide(".slider", 12000)
    app.slide(".slider3", 12000)
    setTimeout(function(){
      app.slide(".slider2", 12000)
      app.slide(".slider4", 12000)
    },6000)
  },
  slide : function(classSlide, duration){
    var $sliders = $( classSlide+' .image-list')
    var orderSlide = []
    var animationEvent = app.whichAnimationEvent();

    //init
    if($sliders.length >1 ){
      console.log('error need 1 slider list per slider')
      return false
    }
    var $slider = $sliders[0]
    var $li =  $($slider).children()

    for(var j =0; j<$li.length; j++){
      orderSlide.push($li[j])

    }
    //listener
    $($slider).on(animationEvent,function(evt){
      if($(this).attr('data-anim') === "fadeOut"){
        app.changeSlide($slider, orderSlide)
        $(orderSlide[0]).css('animation', 'fadeIn 0.8s')
        $(this).attr('data-anim', 'fadeIn')
      }
    })

    if(orderSlide.length <= 1 ){
      return false
    }

    //loop launch
    setInterval(function(){
      $($slider).attr('data-anim', 'fadeOut')
      $(orderSlide[0]).css('animation', 'fadeOut 0.8s')
      orderSlide = app.meldingSlide(orderSlide);
    },duration)
  },
  changeSlide : function(slider, newOrder){
    $(slider).empty();
    for(var i =0; i<newOrder.length; i++){
      $(newOrder[i]).removeAttr("style")
      $(slider).append(newOrder[i])
    }
  },
  meldingSlide : function(arr){
    var newArr = []
    var poped = arr.pop()
    var shifted = arr.shift()
    newArr = arr
    newArr.push(poped)
    newArr.push(shifted)
    return newArr
  },
  whichAnimationEvent: function(){
    var t,
        el = document.createElement("fakeelement");

    var animations = {
      "animation"      : "animationend",
      "OAnimation"     : "oAnimationEnd",
      "MozAnimation"   : "animationend",
      "WebkitAnimation": "webkitAnimationEnd"
    }

    for (t in animations){
      if (el.style[t] !== undefined){
        return animations[t];
      }
    }
  }
 }
 ctx.app = app

})(jQuery, window)