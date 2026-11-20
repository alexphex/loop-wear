<?php get_header(); ?>

<main class="max-w-[1440px] mx-auto px-6 lg:px-8 py-16">
  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <h1 class="text-headline-lg font-headline-lg uppercase mb-6"><?php the_title(); ?></h1>
    <?php the_content(); ?>
  <?php endwhile; endif; ?>
</main>

<?php get_footer(); ?>