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

    })
  },
  initScrollAnim : function(classN){
    $(classN).on('click', function(evt){
     // bloquer le comportement par défaut: on ne rechargera pas la page
     evt.preventDefault();
     // enregistre la valeur de l'attribut  href dans la variable target
     var target = $(this).attr('href');
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