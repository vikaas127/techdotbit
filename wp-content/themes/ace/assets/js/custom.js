jQuery(document).ready(function(){

   // jQuery(".menu > li.menu-item-has-children").prepend("<span></span>");
   //  jQuery(".menu > li.menu-item-has-children > span:nth-child(2)").remove();
   //  jQuery('.menu > li.menu-item-has-children button').remove();

    jQuery(".menu > li.menu-item-has-children > button").click(function(e){    
         e.preventDefault();
         var target = jQuery(this).parent().children('.sub-menu');
         var targetStatus = target.css('display');
         if(targetStatus == 'none'){
          jQuery('.menu > li.menu-item-has-children').children('.sub-menu').slideUp();
          jQuery(".menu > li.menu-item-has-children .sub-menu").removeClass("open"); 
          jQuery(".menu > li.menu-item-has-children").removeClass("active"); 
             target.slideDown();
             jQuery(this).parent().children('.sub-menu').addClass("open");
             jQuery(this).parent().addClass('active');
          }
         else{
            target.slideUp();
            jQuery(this).parent().children('.sub-menu').removeClass("open");
            jQuery(this).parent().removeClass('active');
         }      
    });

    jQuery(".sub-menu > li.menu-item-has-children").prepend("<span></span>");
    jQuery(".sub-menu > li.menu-item-has-children > span:nth-child(2)").remove();

    jQuery(".sub-menu > li.menu-item-has-children > span").click(function(e){    
         e.preventDefault();
         var target = jQuery(this).parent().children('.sub-menu');
         var targetStatus = target.css('display');
         if(targetStatus == 'none'){
          jQuery('.sub-menu > li.menu-item-has-children').children('.sub-menu').slideUp();
          jQuery(".sub-menu > li.menu-item-has-children .sub-menu").removeClass("open"); 
          jQuery(".sub-menu > li.menu-item-has-children").removeClass("active"); 
             target.slideDown();
             jQuery(this).parent().children('.sub-menu').addClass("open");
             jQuery(this).parent().addClass('active');
          }
         else{
            target.slideUp();
            jQuery(this).parent().children('.sub-menu').removeClass("open");
            jQuery(this).parent().removeClass('active');
         }      
    });


    jQuery('#tabs-tools li:first-child').addClass('active');
      jQuery('.tab-content').hide();
      jQuery('.tab-content:first').show();

      // Click function
      jQuery('#tabs-tools li').click(function(){
        jQuery('#tabs-tools li').removeClass('active');
        jQuery(this).addClass('active');
        jQuery('.tab-content').hide();
        
        var activeTab = jQuery(this).find('a').attr('href');
        jQuery(activeTab).fadeIn();
        return false;
    });


	jQuery(".faq-list > li").click(function(e){    
         e.preventDefault();
         var target = jQuery(this).children('.answer');
         var targetStatus = target.css('display');
         if(targetStatus == 'none'){
          jQuery('.faq-list > li').children('.answer').slideUp();
          jQuery(".faq-list > li .question").removeClass("open"); 
             target.slideDown();
             jQuery(this).children('.question').addClass("open");
          }
         else{
            target.slideUp();
            jQuery(this).children('.question').removeClass("open");
         }      
      });
      
      
        jQuery('.counting').each(function() {
          var jQuerythis = jQuery(this),
              countTo = jQuerythis.attr('data-count');
          
          jQuery({ countNum: jQuerythis.text()}).animate({
            countNum: countTo
          },
        
          {
            duration: 3000,
            easing:'linear',
            step: function() {
              jQuerythis.text(Math.floor(this.countNum));
            },
            complete: function() {
              jQuerythis.text(this.countNum);
              //alert('finished');
            }
        
          });  
        });
});

