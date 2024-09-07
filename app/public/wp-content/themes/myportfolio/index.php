
<?php get_header(); ?>
<style>
header .header-menu a {
  color: white;
}
header .logo .name {
  color: white;
}
.header-icon i {
  border: 1px solid white;
}
</style>
<h1 class="top_title"><span class="color-text">Conquer</span> your digital challenges</h1>
<div class="tag_line">
  <h2 class="">We fight for every click</h2>
<h3><?php echo get_option('blogdescription') ?>
   </h3>
<div class="">
  <a class="button-77 pulse" id="cta" role="button" href="/contact">Book Call</a>
</div>

</div>

<div class=" bg-video-wrap">
    <video src="<?php echo get_bloginfo('template_directory'); ?>/img/tableMeeting.mp4" loop muted autoplay>
    </video>
    <div class="overlay">
    </div>
    
  </div>
  
    <!-- <section id="top">
     
    
      <div class="container">
        <div class="info">
          <div class="square"></div>
          <h1><?php echo acronym(get_bloginfo('name')); ?></h1>
          <p>NN Consultant</p>
          <a href="#portfolio-section">Latest Works</a>
        </div>
        <div class="img">
          <div class="background-img">

          </div>
        </div>
      </div>
    </section> -->   


    <!-- SERVICES -->
    <section id="services-section">
      <div class="particles">
      <div id="service-container" class="container">
          <div class="title">
            <div class="circle"></div>

              <h1>services</h1>
          
        </div>
        
        <h2 align="center" class="title-line" style=""> Elevate your brand. We craft digital strategies that drive results.</h2>
        <div class="services-container">

        
        <?php 
            $mypod = pods('service');
            $mypod->find('name ASC');
            ?>
            <?php 
            while ($mypod->fetch()): ?>
            <?php
            // set our variables
            $name = $mypod->field('name');
            $content= $mypod->field('content');
            $permalink= $mypod->field('permalink');
            $icon_class= $mypod->field('icon_class');
            $border_color = $mypod->field('border_color');
            ?>
            <div class="card <?php echo $border_color ?>" data-tilt data-tilt-glare data-tilt-max-glare="0.5" data-tilt-scale="1.1">
          <div class="card-image"></div>
            <div class="card-text">
              <i class="<?php echo $icon_class ?> "></i>
            <h2 class="card-title"><?php echo $name ?></h2>
            <p class="card-content"><?php echo $content ?> </p>
          </div>
          
        </div>
            <?php endwhile; ?>
          
        
        </div>
        
      </div>
      </div>
    
    </section>
    <!-- HERO -->
    <section id="hero-section">
      <div class="container">
      
        <div  class="hero-container">
       <p style="z-index:20;" class="hero-text">Book a <span class=" hero-text color-text">free</span> Consulation</p> 
         <a id="hero-btn" class="button-77 pulse " role="button" href="/contact">Book Call</a>
        </div>
          
      </div>
      <div class="overlay-2"></div>
    </section>
    <!-- PORTFOLIO SECTION -->
    <section id="portfolio-section">
      <div class="container">
        <div class="title">
          <div class="circle-2"></div>
          <h1>portfolio</h1>
        </div>
        <div class="portfolio-container">
        <!-- <div id="slider-container" class="container">
            <div class="slider-banner">
              <div class="slider" style="--quantity: 6">
                
              <div class="item" style="--position:1">
                    <div class="card" data-tilt data-tilt-glare data-tilt-max-glare="0.5" data-tilt-scale="1.1">
                      <div class="card-image card1"></div>
                        <div class="card-text">
                        <h2 class="card-title">Service</h2>
                        <p class="card-content">GX Graded BGS 9.5 Hidden Fates, Mint, not in original packaging. Shipped in a sleeve, top loader, card board, USPS </p>
                      </div>
                      
                    </div>    
                </div>
                   <div class="item" style="--position:2">
                    <div class="card" data-tilt data-tilt-glare data-tilt-max-glare="0.5" data-tilt-scale="1.1">
                      <div class="card-image card2"></div>
                        <div class="card-text">
                        <h2 class="card-title">Service</h2>
                        <p class="card-content">GX Graded BGS 9.5 Hidden Fates, Mint, not in original packaging. Shipped in a sleeve, top loader, card board, USPS </p>
                      </div>
                      
                    </div>    
                   </div>
                   <div class="item" style="--position:3">
                    <div class="card" data-tilt data-tilt-glare data-tilt-max-glare="0.5" data-tilt-scale="1.1">
                      <div class="card-image card3"></div>
                        <div class="card-text">
                        <h2 class="card-title">Service</h2>
                        <p class="card-content">GX Graded BGS 9.5 Hidden Fates, Mint, not in original packaging. Shipped in a sleeve, top loader, card board, USPS </p>
                      </div>
                      
                    </div>    
                   </div>
                   <div class="item" style="--position:4">
                    <div class="card" data-tilt data-tilt-glare data-tilt-max-glare="0.5" data-tilt-scale="1.1">
                      <div class="card-image card4"></div>
                        <div class="card-text">
                        <h2 class="card-title">Service</h2>
                        <p class="card-content">GX Graded BGS 9.5 Hidden Fates, Mint, not in original packaging. Shipped in a sleeve, top loader, card board, USPS </p>
                      </div>
                      
                    </div>    
                   </div>
                   <div class="item" style="--position:5">
                    <div class="card" data-tilt data-tilt-glare data-tilt-max-glare="0.5" data-tilt-scale="1.1">
                      <div class="card-image card5"></div>
                        <div class="card-text">
                        <h2 class="card-title">Service</h2>
                        <p class="card-content">GX Graded BGS 9.5 Hidden Fates, Mint, not in original packaging. Shipped in a sleeve, top loader, card board, USPS </p>
                      </div>
                      
                    </div>    
                   </div>
                   <div class="item" style="--position:6">
                    <div class="card" data-tilt data-tilt-glare data-tilt-max-glare="0.5" data-tilt-scale="1.1">
                      <div class="card-image card6"></div>
                        <div class="card-text">
                        <h2 class="card-title">Service</h2>
                        <p class="card-content">GX Graded BGS 9.5 Hidden Fates, Mint, not in original packaging. Shipped in a sleeve, top loader, card board, USPS </p>
                      </div>
                      
                    </div>    
                   </div>

      
        </div> -->
            <?php 
            $mypod = pods('project');
            $params = array(
              'orderby' => 'name ASC',
              'limit' => -1, //fetches all pods
            );
            // $mypod->find('name ASC'); 
            $mypod = pods('project', $params);
            $loopIndex = 0;
            $totalItems = $mypod->total();

            ?>
           
            
       <!-- SLIDER -->
       <div id="slider-container" class="container">
            <div class="slider-banner">
              <div class="slider" style="--quantity:<?php echo $totalItems; ?>; ">
       <?php 
              while ($mypod->fetch()): ?>
            
            <?php
                // set our variables
                $name = $mypod->field('name');
                $permalink = $mypod->field('permalink');
                $project_url = $mypod->field('project_url');
                $github_url = $mypod->field('github_url');
                $project_type = $mypod->field('project_type');
                $youtube_url = $mypod->field('youtube_url');
                $tech_icon_1 = $mypod->field('tech_icon_1');
                $tech_icon_2 = $mypod->field('tech_icon_2');
                $tech_icon_3 = $mypod->field('tech_icon_3');
                $tech_icon_4 = $mypod->field('tech_icon_4');
                $loopIndex++;
           
                // Featured Image
                $row = $mypod->row();
                    $post_id = $row['ID'];
                    if (!function_exists('get_post_featured_image')) {
                      function get_post_featured_image($post_id, $size) {
                        $return_array = [];
                        $image_id = get_post_thumbnail_id($post_id);
                        $image = wp_get_attachment_image_src($image_id, $size);
                        $image_url = $image[0];
                        $image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
                        $image_post = get_post($image_id);
                        $image_caption = $image_post->post_excerpt;
                        $image_description = $image_post->post_content;
                        $return_array['id'] = $image_id;
                        $return_array['url'] = $image_url;
                        $return_array['alt'] = $image_alt;
                        $return_array['caption'] = $image_caption;
                        $return_array['description'] = $image_description;
                        return $return_array;
                      }
                    }
                    $image_properties = get_post_featured_image($post_id, 'full');
                
                ?>  
                
                <div class="item" style="--position:<?php echo $loopIndex; ?>">
                  <a href="<?php echo $permalink;?>">
                    <div class="card" data-tilt data-tilt-glare data-tilt-max-glare="0.5" data-tilt-scale="1.1">
                      <div class="card-image card<?php echo $loopIndex; ?>" style="background:linear-gradient(#fff0 0%, #fff0 30%, #1d1d1d 100%), url('<?php echo $image_properties['url'] ?>');
                      grid-area: image;
  border-radius: 15px;
  border-top-right-radius: 15px;
  background-size: cover;height: 300px;"></div>
                        <div class="card-text">
                        <h2 class="card-title"><?php echo $name; ?></h2>
                        <p class="card-content"><?php echo $project_type; ?> </p>
                      </div>
                      
                    </div>  
                    </a>  
                </div>

           
            <?php endwhile; ?>
                  </div>
                  </div>
                  </div>
       <!-- END SLIDER -->
                  
        </div>
      </div>
    </section>
    
    <section id="blog-section">
      <div class="container">
        <div class="title">
          
          <h1>News</h1><div class="circle-2"></div>
        </div>
        <div class="blog-container">
          <?php $args = array (
            'numberposts' => 6, // Number of posts to display
          );

          $latest_posts = new WP_Query($args);
          ?>
          
          <?php if ($latest_posts->have_posts()) : 
            while ($latest_posts->have_posts()) : $latest_posts->the_post(); ?>
                
                <a href="<?php the_permalink(); ?>" class="post post-<?php the_ID(); ?>">
                  <div class="post-img" style="background: url(<?php the_post_thumbnail_url('medium_large'); ?>);"></div>
                  <div class="details">
                    <h4><?php the_title(); ?></h4>
                    <p><?php the_excerpt(); ?> </p>
                  </div>
                  <div class="more">
                    <div class="button">
                      Read More
                    </div>
                  </div>
                </a>
               
              
          
            
       
      <?php endwhile; ?>
      <?php else: ?>
        <div class="">
          <h1>Blogs Comming Soon</h1>
        </div>
        <?php endif; ?>
       
        </div>
      </div>
    </section>
    <section id="testimonials-section">
      
      <div class="container">
        <div class="title">
          <div class="circle"></div>
          <h1>Testimonials</h1>
        </div>
        
        <div class="" id="testimonials-app">
          
        
        <div class="testimonial-card">
            <img class="headshot"src="https://placehold.co/600x400?font=roboto" alt="avi" >
            <div class="testimonial-card__content" >
              <div class="testimonial-card__header">
              <h4 class="name">Name</h4>
              <p class="date" align="center" style="animation: none">dd-mm-yyyy</p>
              <div class="rating-row">
             
              <div class="rating-row__fill">
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              </div>
              </div>
              </div>
              
              </div>
              
            <p class="comment" align="center" style="animation: none">Very knowledgeable and puts a lot of time into his work</p>
            
            <div align="center" class="google"> </div>
        
          </div>
          </div>
          
        
      </div>
<div class="loader">
      <div class="wrapper">
            
            
            <!-- <div class="testimonial-card item item2">
                    <img class="headshot"src="https://placehold.co/600x400?font=roboto" alt="avi" >
                    <div class="testimonial-card__content" >
                      <div class="testimonial-card__header">
                      <h4 class="name">Name</h4>
                      <p class="date" align="center" style="animation: none">dd-mm-yyyy</p>
                      <div class="rating-row">
                    
                      <div class="rating-row__fill">
                      <i class="fa-solid fa-star"></i>
                      <i class="fa-solid fa-star"></i>
                      <i class="fa-solid fa-star"></i>
                      <i class="fa-solid fa-star"></i>
                      <i class="fa-solid fa-star"></i>
                      </div>
                      </div>
                      </div>
                      
                      </div>
                      
                    <p class="comment" align="center" style="animation: none">Very knowledgeable and puts a lot of time into his work</p>
                    
                    <img align="center" class="google" src="<?php echo get_bloginfo('template_directory'); ?>/img/google.png" alt="">
              
            </div>
            <div class="testimonial-card item item3">
                    <img class="headshot"src="https://placehold.co/600x400?font=roboto" alt="avi" >
                    <div class="testimonial-card__content" >
                      <div class="testimonial-card__header">
                      <h4 class="name">Name</h4>
                      <p class="date" align="center" style="animation: none">dd-mm-yyyy</p>
                      <div class="rating-row">
                    
                      <div class="rating-row__fill">
                      <i class="fa-solid fa-star"></i>
                      <i class="fa-solid fa-star"></i>
                      <i class="fa-solid fa-star"></i>
                      <i class="fa-solid fa-star"></i>
                      <i class="fa-solid fa-star"></i>
                      </div>
                      </div>
                      </div>
                      
                      </div>
                      
                    <p class="comment" align="center" style="animation: none">Very knowledgeable and puts a lot of time into his work</p>
                    
                    <img align="center" class="google" src="<?php echo get_bloginfo('template_directory'); ?>/img/google.png" alt="">
              
            </div>
            <div class="testimonial-card item item4">
                    <img class="headshot"src="https://placehold.co/600x400?font=roboto" alt="avi" >
                    <div class="testimonial-card__content" >
                      <div class="testimonial-card__header">
                      <h4 class="name">Name</h4>
                      <p class="date" align="center" style="animation: none">dd-mm-yyyy</p>
                      <div class="rating-row">
                    
                      <div class="rating-row__fill">
                      <i class="fa-solid fa-star"></i>
                      <i class="fa-solid fa-star"></i>
                      <i class="fa-solid fa-star"></i>
                      <i class="fa-solid fa-star"></i>
                      <i class="fa-solid fa-star"></i>
                      </div>
                      </div>
                      </div>
                      
                      </div>
                      
                    <p class="comment" align="center" style="animation: none">Very knowledgeable and puts a lot of time into his work</p>
                    
                    <img align="center" class="google" src="<?php echo get_bloginfo('template_directory'); ?>/img/google.png" alt="">
              
            </div>
            <div class="testimonial-card item item5">
                    <img class="headshot"src="https://placehold.co/600x400?font=roboto" alt="avi" >
                    <div class="testimonial-card__content" >
                      <div class="testimonial-card__header">
                      <h4 class="name">Name</h4>
                      <p class="date" align="center" style="animation: none">dd-mm-yyyy</p>
                      <div class="rating-row">
                    
                      <div class="rating-row__fill">
                      <i class="fa-solid fa-star"></i>
                      <i class="fa-solid fa-star"></i>
                      <i class="fa-solid fa-star"></i>
                      <i class="fa-solid fa-star"></i>
                      <i class="fa-solid fa-star"></i>
                      </div>
                      </div>
                      </div>
                      
                      </div>
                      
                    <p class="comment" align="center" style="animation: none">Very knowledgeable and puts a lot of time into his work</p>
                    
                    <img align="center" class="google" src="<?php echo get_bloginfo('template_directory'); ?>/img/google.png" alt="">
              
            </div>

            <div class="testimonial-card item item6">
                    <img class="headshot"src="https://placehold.co/600x400?font=roboto" alt="avi" >
                    <div class="testimonial-card__content" >
                      <div class="testimonial-card__header">
                      <h4 class="name">Name</h4>
                      <p class="date" align="center" style="animation: none">dd-mm-yyyy</p>
                      <div class="rating-row">
                    
                      <div class="rating-row__fill">
                      <i class="fa-solid fa-star"></i>
                      <i class="fa-solid fa-star"></i>
                      <i class="fa-solid fa-star"></i>
                      <i class="fa-solid fa-star"></i>
                      <i class="fa-solid fa-star"></i>
                      </div>
                      </div>
                      </div>
                      
                      </div>
                      
                    <p class="comment" align="center" style="animation: none">Very knowledgeable and puts a lot of time into his work</p>
                    
                    <img align="center" class="google" src="<?php echo get_bloginfo('template_directory'); ?>/img/google.png" alt="">
              
            </div>
            <div class="testimonial-card item item7">
                    <img class="headshot"src="https://placehold.co/600x400?font=roboto" alt="avi" >
                    <div class="testimonial-card__content" >
                      <div class="testimonial-card__header">
                      <h4 class="name">Name</h4>
                      <p class="date" align="center" style="animation: none">dd-mm-yyyy</p>
                      <div class="rating-row">
                    
                      <div class="rating-row__fill">
                      <i class="fa-solid fa-star"></i>
                      <i class="fa-solid fa-star"></i>
                      <i class="fa-solid fa-star"></i>
                      <i class="fa-solid fa-star"></i>
                      <i class="fa-solid fa-star"></i>
                      </div>
                      </div>
                      </div>
                      
                      </div>
                      
                    <p class="comment" align="center" style="animation: none">Very knowledgeable and puts a lot of time into his work</p>
                    
                    <img align="center" class="google" src="<?php echo get_bloginfo('template_directory'); ?>/img/google.png" alt="">
              
            </div>
            <div class="testimonial-card item item8">
                    <img class="headshot"src="https://placehold.co/600x400?font=roboto" alt="avi" >
                    <div class="testimonial-card__content" >
                      <div class="testimonial-card__header">
                      <h4 class="name">Name</h4>
                      <p class="date" align="center" style="animation: none">dd-mm-yyyy</p>
                      <div class="rating-row">
                    
                      <div class="rating-row__fill">
                      <i class="fa-solid fa-star"></i>
                      <i class="fa-solid fa-star"></i>
                      <i class="fa-solid fa-star"></i>
                      <i class="fa-solid fa-star"></i>
                      <i class="fa-solid fa-star"></i>
                      </div>
                      </div>
                      </div>
                      
                      </div>
                      
                    <p class="comment" align="center" style="animation: none">Very knowledgeable and puts a lot of time into his work</p>
                    
                    <img align="center" class="google" src="<?php echo get_bloginfo('template_directory'); ?>/img/google.png" alt="">
              
            </div>              -->
                
              
            
               
             
              
              </div>

              </div>
          
        </div>
        
      </div>
    </section>
    <?php get_footer(); ?>
   
