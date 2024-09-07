<?php get_header(); ?>

<section id="page-template">
    <div class="container">
        <?php if (have_posts()): ?>
    <?php while (have_posts()): the_post(); ?>
        <!-- Your post content here -->
      <h1>  <?php the_title(); ?> </h1>
        <?php the_content(); ?>
    <?php endwhile; ?>
<?php else: ?>
    <!-- Display a message when no posts are found -->
    <p>No posts found.</p>
<?php endif; ?>
    </div>
</section>



<?php get_footer(); ?>