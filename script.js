$(document).ready(function(){

    $('#menu').click(function(){
        $(this).toggleClass('fa-times');
        $('.navbar').toggleClass('nav-toggle');
    });

    $(window).on('scroll load',function(){

      $('#menu').removeClass('fa-times');
      $('.navbar').removeClass('nav-toggle');

      if($(window).scrollTop() > 0){
        $('.scroll-top').show();
      }else{
        $('.scroll-top').hide();
      }

      // scroll spy 

      
    $('section').each(function(){

      let height = $(this).height();
      let offset = $(this).offset().top - 200;
      let id = $(this).attr('id');
      let top = $(window).scrollTop();

      if(top > offset && top < offset + height){
        $('.navbar ul li a').removeClass('active')
        $('.navbar').find(`[href="#${id}"]`).addClass('active');
      }

    });

    });

    // smooth scrolling

    $('a[href*="#"]').on('click',function(e){

      e.preventDefault();

      $('html, body').animate({

        scrollTop : $($(this).attr('href')).offset().top,

      },
      500,
      'linear'
      )

    })

});


    function animateValue(obj, start, end, duration) {
        let startTimestamp = null;
        const step = (timestamp) => {
            if (!startTimestamp) startTimestamp = timestamp;
            const progress = Math.min((timestamp - startTimestamp) / duration, 1);
            obj.innerHTML = Math.floor(progress * (end - start) + start);
            if (progress < 1) {
                window.requestAnimationFrame(step);
            }
        };
        window.requestAnimationFrame(step);
    }
    var n1=document.getElementById("numberdon1").innerHTML;
    var n2=document.getElementById("numberdon2").innerHTML;
    var n3=document.getElementById("numberdon3").innerHTML;
    var n4=document.getElementById("numberdon4").innerHTML;
    var n5=document.getElementById("numberdon5").innerHTML;
    var n6=document.getElementById("numberdon6").innerHTML;
    var n7=document.getElementById("numberdon7").innerHTML;
    var n8=document.getElementById("numberdon8").innerHTML;
    

    //console.log(n2);
    const obj1 = document.getElementById("a+");
    animateValue(obj1, 0, n1, 1000);

    const obj2 = document.getElementById("b+");
    animateValue(obj2, 0, n2, 1000);

    const obj3 = document.getElementById("ab+");
    animateValue(obj3, 0, n3, 1000);

    const obj4 = document.getElementById("o+");
    animateValue(obj4, 0, n4, 1000);

    const obj5 = document.getElementById("a-");
    animateValue(obj5, 0, n5, 1000);

    const obj6 = document.getElementById("b-");
    animateValue(obj6, 0, n6, 1000);

    const obj7 = document.getElementById("ab-");
    animateValue(obj7, 0, n7, 1000);

    const obj8 = document.getElementById("o-");
    animateValue(obj8, 0, n8, 1000);


    