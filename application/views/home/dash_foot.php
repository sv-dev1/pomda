<div class="dash-footer">
<!-- footer start -->
<div class="container footer">
  <div class="row">
    <div class="col-md-12">
      <div class="footer_section">
        <ul class="footer_link">
          <li><a href="#">Home</a></li>
          <li><a href="#">Terms and Conditions</a></li>
          <li><a href="#">FAQ</a></li>
          <!-- <li><a href="#">Careers</a></li> -->
<!--           <li><a href="#">MVP</a></li> -->
          <li><a href="#">Whitepaper</a></li>
        </ul>
        <div class="wi-content wi-social">
          <ul>
            <li>
              <a href="#">
                <img src="<?php echo site_url() ?>images/si1.png" class="img-responsive si_icon" />                         
              </a>
            </li>
            <li>
              <a href="#">
                <img src="<?php echo site_url() ?>images/si2.png" class="img-responsive si_icon" />                       
              </a>
            </li>
            <li>
              <a href="#">
                <img src="<?php echo site_url() ?>images/si3.png" class="img-responsive si_icon" />                         
              </a>
            </li>
            <li>
              <a href="#">
                <img src="<?php echo site_url() ?>images/si4.png" class="img-responsive si_icon" />   
              </a>
            </li>
            <li>
              <a href="#">
                <img src="<?php echo site_url() ?>images/si5.png" class="img-responsive si_icon" />                 
              </a>
            </li>
            <li>
              <a href="#">
                <img src="<?php echo site_url() ?>images/si6.png" class="img-responsive si_icon" />                         
              </a>
            </li>
            <li>
              <a href="#">
                <img src="<?php echo site_url() ?>images/si7.png" class="img-responsive si_icon" />                     
              </a>
            </li>
          </ul>
          <a href="#" class="a_col">help@kicktoken.com</a>
          <p>Kick Software LTD. Suite C, Orion Mall, Palm Street, Victoria Seychelles</p>
          <h1>© 2018 KickToken</h1>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<!-- footer end -->



<!-- fixed start -->
<div class="contacts-buttons">
  <a class="telegram"href="#"><i></i></a>
  <a class="chat" href="#"><i></i></a>
</div>
<!-- fixed end -->
<!-- Trigger the modal with a button -->

<a type="button" id="a_mdl" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal1">Open Modal</a>
<!-- Modal -->
<div id="myModal1" class="modal fade" role="dialog">
  <div class="modal-dialog"> 

    <!-- Modal content-->
    <div class="modal-content modal-content1">  
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <div class="modal-body modal-body1">
        <iframe width="100%" height="360" src="https://www.youtube.com/embed/tgbNymZ7vqY"></iframe>
      </div>

    </div>

  </div>
</div>
<script src="<?php echo base_url();?>assets/js/particles.js"></script>
<script src="<?php echo base_url();?>assets/js/app.js"></script>

<!-- stats.js -->
<script src="<?php echo base_url();?>assets/js/stats.js"></script>

<script>
  var count_particles, stats, update;
  stats = new Stats;
  stats.setMode(0);
  stats.domElement.style.position = 'absolute';
  stats.domElement.style.left = '0px';
  stats.domElement.style.top = '0px';
  document.body.appendChild(stats.domElement);
  count_particles = document.querySelector('.js-count-particles');
  update = function() {
    stats.begin();
    stats.end();
    if (window.pJSDom[0].pJS.particles && window.pJSDom[0].pJS.particles.array) {
      count_particles.innerText = window.pJSDom[0].pJS.particles.array.length;
    }
    requestAnimationFrame(update);
  };
  requestAnimationFrame(update);
</script>

<script type="text/javascript">
jQuery(window).scroll(function() {  

  var scroll = jQuery(window).scrollTop();

  if (scroll >= 100) {
    jQuery("body").addClass("fixed-header");
  } else {
    jQuery("body").removeClass("fixed-header");
  }
});
</script>
<script type="text/javascript">
$(document).ready(function(){
  $('#video_prv').click(function(){
   // alert('heree');
   $('#a_mdl').click(); 
 });
  var modal_check = <?php echo $modal_open;?>;
    //alert(modal_check);
    if(modal_check == '1'){
      $('#a_mdl').click();    
    }
    
    
  });

</script>


<script type='text/javascript' src="<?php echo site_url(); ?>assets/js/jquery.bundle.js?ver=113"></script>
  <script type='text/javascript' src="<?php echo site_url(); ?>assets/js/script.js?ver=113"></script>
</body>
</html> 


