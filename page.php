<?php get_header(); ?>

<main class="max-w-[1440px] mx-auto px-6 lg:px-8 py-10">
  <?php while (have_posts()) : the_post(); ?>

    <div class="bg-tertiary-fixed border-3 border-on-surface shadow-[6px_6px_0px_#121212] p-6 md:p-8 mb-10">
      <div class="bg-on-surface text-surface px-2.5 py-0.5 text-label-sm font-label-sm font-extrabold uppercase inline-block mb-2">LOOP WEAR</div>
      <h1 class="text-4xl md:text-headline-lg font-headline-lg text-on-tertiary-fixed uppercase tracking-tight"><?php the_title(); ?></h1>
    </div>

    <div class="page-content">
      <?php the_content(); ?>
    </div>

  <?php endwhile; ?>
</main>

<?php get_footer(); ?>