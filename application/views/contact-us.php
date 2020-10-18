
      <div class="contact-map">
         <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script><div style="overflow:hidden;height:351px;width:100%;"><div id="gmap_canvas" style="height:351px;width:100%;"><style>#gmap_canvas img{max-width:none!important;background:none!important}</style><a class="google-map-code" href="http://www.pblack.de" id="get-map-data"></a></div></div><script type="text/javascript"> function init_map(){var myOptions = {zoom:6,center:new google.maps.LatLng(55.378051,-3.43597299999999),mapTypeId: google.maps.MapTypeId.ROADMAP,scrollwheel: false};map = new google.maps.Map(document.getElementById("gmap_canvas"), myOptions);marker = new google.maps.Marker({map: map,position: new google.maps.LatLng(55.378051, -3.43597299999999)});infowindow = new google.maps.InfoWindow({content:"<b>United Kingdom</b><br/><br/> United Kingdom" });google.maps.event.addListener(marker, "click", function(){infowindow.open(map,marker);});infowindow.open(map,marker);}google.maps.event.addDomListener(window, 'load', init_map);</script>
      </div>
<div class="middle-content inner-middle">
         <div class="container">
            <div class="row">
               <form method="post" action="">
               <div class="col-sm-12 col-md-7 col-lg-7">
                  <div class="contact-form">
                     <h3>Get In Touch with Us</h3>
                     <div class="user-one">
                        <input type="text" tabindex="1" class="con-input" name="name" id="name" placeholder="Name" /> 
                        <span class="text-danger" id="err_name"><?php echo form_error('name'); ?></span>
                     </div>
                     <div class="user-one">
                        <input type="text" tabindex="2" class="con-input" name="mobile_num" id="mobile_num" placeholder="Mobile No." /> 
                        <span class="text-danger" id="err_mobile_num"><?php echo form_error('mobile_num'); ?></span>
                     </div>
                     <div class="user-one">
                        <input type="text" tabindex="3" class="con-input" name="email" id="email" placeholder="Email" /> 
                        <span class="text-danger" id="err_email"><?php echo form_error('email'); ?></span>
                     </div>
                     <div class="user-one">
                        <textarea class="con-input" tabindex="4" rows="" cols="" name="message" id="message" placeholder="Message" style="height:151px;padding-top:10px"></textarea>
                        <span class="text-danger" id="err_message"><?php echo form_error('message'); ?></span>
                     </div>
                     <div class="user-one">
                        <div class="submit-btn">
                           <button type="button" tabindex="5" name="btn_contact_us" id="btn_contact_us" class="sub-btn hvr-bounce-to-bottom"> Submit Now</button>
                        </div>
                     </div>
                  </div>
               </div>
            </form>
               <div class="col-sm-12 col-md-5 col-lg-5">
                  <div class="contact-form">
                     <h3>Contact Info</h3>
                     <div class="contact-details">
                        <ul>
                           <li>
                              <span><img src="<?php echo base_url(); ?>assets/images/con-email.png" alt="contact email icon"/></span> Info@medscanner.com
                           </li>
                           <li>
                              <span><img src="<?php echo base_url(); ?>assets/images/con-phn.png" alt="phone icon"/></span> +01-234-5789
                           </li>
                           <li>
                              <span><img src="<?php echo base_url(); ?>assets/images/con-tel.png" alt="telephone iocn"/> </span> 0333 011 1901
                           </li>
                        </ul>
                     </div>
                     <div class="hve-que">
                        <div class="have-head">
                           Have Any Question?
                        </div>
                        <div class="have-content">
                           Getting in touch? If You have any more Question Not Listed in.
                           <button type="button" tabindex="6" class="ask-btn hvr-bounce-to-bottom">Ask a Question </button>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
     
      <script type="text/javascript">
         /*wow = new WOW({
             animateClass: 'animated',
             offset: 100,
             callback: function(box) {
                 console.log("WOW: animating <" + box.tagName.toLowerCase() + ">")
             }
         });
         wow.init();
         document.getElementById('moar').onclick = function() {
             var section = document.createElement('section');
             section.className = 'section--purple wow fadeInDown';
             this.parentNode.insertBefore(section, this);
         };*/

         $('#btn_contact_us').on('click',function(){
               var name          = $('#name').val();
               var email         = $('#email').val();
               var mobile_num    = $('#mobile_num').val();
               var message       = $('#message').val();
               var filter        = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
               var flag          = 1;

               if(name == '')
               {
                  $('#err_name').text('Please enter your name.');
                  flag = 0;
               }
               else 
               {
                  $('#err_name').text('');
               }
               if(email == '')
               {
                  $('#err_email').text('Please enter you email id.');
                  flag = 0;
               }
               else if(!filter.test(email))
               {
                  $('#err_email').text('Please enter valid email address');
                  flag = 0;
               }
               else 
               {
                  $('#err_email').text('');
               }
               if(mobile_num == '')
               {
                  $('#err_mobile_num').text('Please enter your mobile number.')
                  flag = 0;
               }
               else 
               {
                  $('#err_mobile_num').text('');
               }
               if(message == '')
               {
                  $('#err_message').text('Please enter message.');
                  flag = 0;
               }
               else 
               {
                  $('#err_message').text('');
               }
               if(flag == 0)
               {
                  return false;
               }
               else 
               {
                  return true;
               }
         });
      </script>
   </body>
</html>