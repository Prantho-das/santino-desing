<?php
/**
 * The main template file
 *
 * @package Santino
 */

get_header();
?>

<main id="primary" class="site-main py-5">
    <div class="container py-5">
        <?php if ( have_posts() ) : ?>
            <div class="row g-4">
                <?php while ( have_posts() ) : the_post(); ?>
                    <div class="col-md-6 col-lg-4">
                        <article id="post-<?php the_ID(); ?>" <?php post_class( 'card h-100 shadow-sm border-0 rounded-4 overflow-hidden' ); ?>>
                            <?php if ( has_post_thumbnail() ) : ?>
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail( 'medium_large', array( 'class' => 'card-img-top' ) ); ?>
                                </a>
                            <?php endif; ?>
                            <div class="card-body p-4">
                                <h3 class="card-title h5 font-heading">
                                    <a href="<?php the_permalink(); ?>" class="text-decoration-none text-dark">
                                        <?php the_title(); ?>
                                    </a>
                                </h3>
                                <div class="text-muted small mb-3"><?php echo get_the_date(); ?></div>
                                <p class="card-text text-muted"><?php echo wp_trim_words( get_the_excerpt(), 20 ); ?></p>
                                <a href="<?php the_permalink(); ?>" class="btn btn-outline-dark btn-sm rounded-pill">Read More</a>
                            </div>
                        </article>
                    </div>
                <?php endwhile; ?>
            </div>
            <div class="mt-5 d-flex justify-content-center">
                <?php the_posts_pagination(); ?>
            </div>
        <?php else : ?>
            <div class="text-center py-5">
                <h2 class="h4 font-heading">No content found</h2>
                <p class="text-muted">It seems we can't find what you're looking for.</p>
            </div>
        <?php endif; ?>
    </div>
</main>

<?php
get_footer();
