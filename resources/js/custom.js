$(document).ready(function () {

    // Disable before submit
    $(window).on('beforeunload', function () {
        $(".btnSubmit").prop('disabled', true);
        $(".btnSubmit").html('Please wait for a second')
    });

    //  Sidebar
     //     if($(window).width() < 1200) {
             var trigger = $('#close-sidebar h2');
 
             trigger.click(function(){
                 $("#toggled").removeClass("toggled");
             });
     //     }
     //     else {
     //         $("#toggled").addClass("toggled");
     //     }
     
 
     $("#close-sidebar").click(function() {
         $(".page-wrapper").removeClass("toggled");
     });
     $("#show-sidebar").click(function() {
         $(".page-wrapper").addClass("toggled");
     });
 
     $(".sidebar-dropdown > a").click(function() {
         $(".sidebar-submenu").slideUp(200);
         if (
             $(this)
                 .parent()
                 .hasClass("active")
         ) {
             $(".sidebar-dropdown").removeClass("active");
             $(this)
                 .parent()
                 .removeClass("active");
         } else {
             $(".sidebar-dropdown").removeClass("active");
             $(this)
                 .next(".sidebar-submenu")
                 .slideDown(200);
             $(this)
                 .parent()
                 .addClass("active");
         }
     });

     if ($(window).width() < 992) {
        $("#toggled").removeClass("toggled");
     }

     // Show Modal
    var myModal = new bootstrap.Modal(document.getElementById('alert'))
    myModal.show();
 });