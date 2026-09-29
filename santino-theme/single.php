<?php
/**
 * Single post template
 *
 * @package Santino
 */

get_header();
?>

<main id="primary" class="site-main py-5">
    <div class="container py-4">
        <?php
        while ( have_posts() ) :
            the_post();
            ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class( 'mx-auto' ); ?> style="max-width: 860px;">
                <header class="entry-header mb-4">
                    <h1 class="entry-title display-5 fw-bold font-heading text-dark mb-3"><?php the_title(); ?></h1>
                    <div class="text-muted small">
                        <span><i class="bi bi-calendar3 me-1"></i> <?php echo get_the_date(); ?></span>
                        <span class="mx-2">&bull;</span>
                        <span><i class="bi bi-person me-1"></i> <?php the_author(); ?></span>
                    </div>
                </header>

                <?php if ( has_post_thumbnail() ) : ?>
                    <div class="mb-4 rounded-4 overflow-hidden shadow-sm">
                        <?php the_post_thumbnail( 'large', array( 'class' => 'img-fluid w-100' ) ); ?>
                    </div>
                <?php endif; ?>

                <div class="entry-content lead text-secondary lh-lg mb-5">
                    <?php the_content(); ?>
                </div>

                <?php
                if ( comments_open() || get_comments_number() ) :
                    comments_template();
                endif;
                ?>
            </article>
            <?php
        endwhile;
        ?>
    </div>
</main>

<?php
get_footer();
