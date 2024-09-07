<!-- <footer>
      <div class="social-container">
        <a href="http://www.facebook.com/">
          <i class="fab fa-facebook"></i>
        </a>
        <a href="http://www.dribbble.com/">
          <i class="fab fa-linkedin"></i>
        </a>
        <a href="http://www.facebook.com/">
          <i class="fa-brands fa-x-twitter"></i>
        </a>
        <a href="http://www.facebook.com/">
          <i class="fab fa-instagram"></i>
        </a>
      </div>
      <h5>Chris Norton Jr</h5>
      <h6>Web Developer</h6>
    </footer> -->

    <footer>
       <div>
            <span class="logo">TechNinja</span>
       </div>

       <div class="row">
            <div class="col-3">                
                <div class="link-cat" onclick="footerToggle(this)">
                    <span class="footer-toggle"></span>
                    <span class="footer-cat">Solutions</span>
                </div>
                <ul class="footer-cat-links">
                    <li><a href=""><span>Marketing Campaigns</span></a></li>
                    <li><a href=""><span>Logo Design</span></a></li>
                    <li><a href=""><span>Websites</span></a></li>
                </ul>
            </div>
            <div class="col-3">
                <div class="link-cat" onclick="footerToggle(this)">
                    <span class="footer-toggle"></span>
                    <span class="footer-cat">Industries</span>
                </div>
                <ul class="footer-cat-links">
                    <li><a href=""><span>Healthcare</span></a></li>
                    <li><a href=""><span>Landscaping</span></a></li>
                    <li><a href=""><span>E-Commerce</span></a></li>
                    <li><a href=""><span>Construction</span></a></li>
                    <li><a href=""><span>Club</span></a></li>
                </ul>
            </div>
            <div class="col-3">
                <div class="link-cat" onclick="footerToggle(this)">
                    <span class="footer-toggle"></span>
                    <span class="footer-cat">Quick Links</span>
                </div>
                <ul class="footer-cat-links">
                    <li><a href=""><span>Reviews</span></a></li>
                    <li><a href=""><span>Terms & Condition</span></a></li>
                    <li><a href=""><span>Disclaimer</span></a></li>
                    <li><a href=""><span>Site Map</span></a></li>
                </ul>
            </div>
            <div class="col-3" id="newsletter">
                <span>Stay In Touch</span>
                <form id="subscribe">
                    <input type="email" id="subscriber-email" placeholder="Enter Email Address"/>
                    <input type="submit" value="Subscribe" id="btn-scribe"/>
                </form>
                
                <div class="social-links social-2">
                    <a href=""><i class="fab fa-facebook-f"></i></a>
                    <a href=""><i class="fab fa-x-twitter"></i></a>
                    <a href=""><i class="fab fa-linkedin-in"></i></a>
                    <a href=""><i class="fab fa-instagram"></i></a>
                    <a href=""><i class="fab fa-youtube"></i></a>
                    <!-- <a href=""><i class="fab fa-reddit-alien"></i></a> -->
                </div>

                <div id="address">
                    <span>Office Location</span>
                    <ul>
                        <li>
                            <i class="far fa-building"></i>
                            <div>Tampa<br/>
                             Florida</div>
                        </li>
                        <!-- <li>
                            <i class="fas fa-gopuram"></i>
                            <div>Delhi<br/>
                            Office 150B, Behind Sana Gate Char Bhuja Tower, Station Road, Delhi</div>
                        </li> -->
                    </ul>
                </div>
                
            </div>
            <div class="social-links social-1 col-6">
                <a href=""><i class="fab fa-facebook-f"></i></a>
                <a href=""><i class="fab fa-x-twitter"></i></a>
                <a href=""><i class="fab fa-linkedin-in"></i></a>
                <a href=""><i class="fab fa-instagram"></i></a>
                <a href=""><i class="fab fa-youtube"></i></a>
                <!-- <a href=""><i class="fab fa-reddit-alien"></i></a> -->
            </div>
       </div>
       <div id="copyright">
           &copy; All Rights Reserved 2024
       </div>
       <div id="owner">
           <span>
               Designed by <a href="https://www.chrisnortonjr.com">WebTechNinjas</a>
           </span>
       </div>
    </footer>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    

    <script type="module" src="<?php echo get_bloginfo('template_directory'); ?>/js/app.js"></script>
    <script type="module" src="<?php echo get_bloginfo('template_directory'); ?>/js/vanilla-tilt.min.js"></script>
    
   

<?php wp_footer(); ?>
  </body>
</html>