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
             jQuery(".menu > li.menu-item-has-children > button").attr("aria-expanded", "false");
             target.slideDown();
             jQuery(this).parent().children('.sub-menu').addClass("open");
             jQuery(this).parent().addClass('active');
             jQuery(this).attr("aria-expanded", "true");
          }
         else{
            target.slideUp();
            jQuery(this).parent().children('.sub-menu').removeClass("open");
            jQuery(this).parent().removeClass('active');
            jQuery(this).attr("aria-expanded", "false");
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


    // Tabs: each tab list only controls the panels in its own section, so
    // pages with several tab sets (e.g. project pages) don't interfere.
    jQuery('.tools-tab, .feature-tab > ul').each(function(){
        var $list = jQuery(this);
        var $panels = $list.closest('.lqd-section, .feature-tab, .row').find('.tab-content');
        $list.find('li').removeClass('active').first().addClass('active');
        $panels.hide().first().show();
        $list.find('li').on('click', function(){
            $list.find('li').removeClass('active');
            jQuery(this).addClass('active');
            $panels.hide();
            var target = jQuery(this).find('a').attr('href');
            if (target && target.length > 1) {
                $panels.filter(function(){ return '#' + this.id === target; }).fadeIn();
            }
            return false;
        });
    });


	// Only the question toggles, so links inside an answer keep working.
	jQuery(".faq-list > li > .question").click(function(e){    
         e.preventDefault();
         var target = jQuery(this).parent().children('.answer');
         var targetStatus = target.css('display');
         if(targetStatus == 'none'){
          jQuery('.faq-list > li').children('.answer').slideUp();
          jQuery(".faq-list > li .question").removeClass("open"); 
             target.slideDown();
             jQuery(this).addClass("open");
          }
         else{
            target.slideUp();
            jQuery(this).removeClass("open");
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

