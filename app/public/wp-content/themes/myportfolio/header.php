<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title><?php echo get_bloginfo('name') ?>  | </title>
    <meta name="viewport" content="width=device-width, user-scalable=no">
    <link rel="stylesheet" href="<?php echo get_bloginfo('template_directory'); ?>/css/main.css?counter=<?php echo time(); ?>">
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    

  <?php wp_head(); ?>
  </head>
  <body>
    <header>
      <?php 
      function acronym($str, $as_space = array('-')) {
      $str = str_replace($as_space, ' ', trim($str));
      $ret = '';
      foreach(explode(' ', $str) as $word) {
      $ret .= strtoupper($word[0]);
      }
      return $ret;
    }
      ?>
        <div class="logo">
           <!-- <a href="/" class="name"> </a> -->
          <div class="name" > <?php echo get_bloginfo('name'); ?></div></div>
        </div>
        <div class="header-menu">
          <a href="/">Home</a>
          <a href="/about">About</a>
          <a href="/#services-section">Services</a>
          <a href="/#portfolio-section">Work</a>
          <!-- <a href="/#experience-section">Experience</a> -->
          <a href="/#blog-section">News</a>
          <a href="/#testimonials-section">Testimonials</a>
          <a href="/contact">Contact</a>
    
          <a class="header-icon" href="tel:"><i class="fa-solid fa-phone"></i></a>
          <a class="header-icon" href="mailto:"><i class="fa-solid fa-paper-plane-top"></i></a>
        </div>
        <div class="menu-btn">
          <i class="fas fa-bars"></i>
        </div>
    </header>
    <div class="mobile-menu">
      <a href="/">Home</a>
      <a href="/about">About</a>
      <a href="/#services-section">Services</a>
      <a href="/#portfolio-section">Portfolio</a>
      <a href="/#experience-section">Experience</a>
      <a href="/#blog-section">Blog</a>
      <a href="/#testimonials-section">Testimonials</a>
      <a href="/contact">Contact</a>
    </div>