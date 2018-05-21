<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Full Content Template
 *
Template Name:  Full Width Page (no sidebar)
 *
 * @file           full-width-page.php
 * @package        Responsive
 * @author         Emil Uzelac
 * @copyright      2003 - 2014 CyberChimps
 * @license        license.txt
 * @version        Release: 1.0
 * @filesource     wp-content/themes/responsive/full-width-page.php
 * @link           http://codex.wordpress.org/Theme_Development#Pages_.28page.php.29
 * @since          available since Release 1.0
 */

get_header(); ?>
<div id="content-outer">
<div id="content-full" class="grid col-940">

	<?php if ( have_posts() ) : ?>

		<?php while( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'loop-header', get_post_type() ); ?>

			<?php responsive_entry_before(); ?>
			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<?php responsive_entry_top(); ?>


        <?php if( get_field('editors_introduction') ): ?>
          <div class="essays-post-intro">
            <div class="editors_introduction">
              <?php the_field('editors_introduction'); ?>
            </div>
            <div class="introduction_author">
              By <?php the_field('introduction_author'); ?>
            </div>
            <div class="introduction_date">
              Published on <?php the_field('introduction_date'); ?>
            </div>
          </div>
        <?php endif; ?>

				<?php get_template_part( 'post-meta', get_post_type() ); ?>

        <div class="essays-post-subtitle">
          <?php the_field('subtitle'); ?>
        </div>

        <div class="essays-post-byline">
          By <span><?php the_field('author'); ?></span>
        </div>
        <div class="essays-post-date">
          Published <span><?php the_field('essay_date'); ?></span>
        </div>

				<div class="post-entry">
					<?php responsive_page_featured_image(); ?>
					<?php the_content( __( 'Read more &#8250;', 'responsive' ) ); ?>
					<?php wp_link_pages( array( 'before' => '<div class="pagination">' . __( 'Pages:', 'responsive' ), 'after' => '</div>' ) ); ?>
				</div>
				<!-- end of .post-entry -->

        <div class="essays-post-bibliography">
          <h1>Bibliography</h1>
          <div class="bibliography-content"><?php the_field('bibliography'); ?></div>
        </div>

        <div class="essays-post-editors_note">
          <?php if( get_field('add_editors_note') ): ?>
            <h2>Editor's Note:</h2>
            <div class="editors_note">
              <?php the_field('add_editors_note'); ?>
            </div>
          <?php endif; ?>
          <?php if( get_field('add_editors_note_2') ): ?>
            <div class="editors_note">
              <?php the_field('add_editors_note_2'); ?>
            </div>
          <?php endif; ?>
          <?php if( get_field('add_editors_note_3') ): ?>
            <div class="editors_note">
              <?php the_field('add_editors_note_3'); ?>
            </div>
          <?php endif; ?>
          <?php if( get_field('add_editors_note_4') ): ?>
            <div class="editors_note">
              <?php the_field('add_editors_note_4'); ?>
            </div>
          <?php endif; ?>
          <?php if( get_field('add_editors_note_5') ): ?>
            <div class="editors_note">
              <?php the_field('add_editors_note_5'); ?>
            </div>
          <?php endif; ?>
          <?php if( get_field('add_editors_note_6') ): ?>
            <div class="editors_note">
              <?php the_field('add_editors_note_6'); ?>
            </div>
          <?php endif; ?>
          <?php if( get_field('add_editors_note_7') ): ?>
            <div class="editors_note">
              <?php the_field('add_editors_note_7'); ?>
            </div>
          <?php endif; ?>
          <?php if( get_field('add_editors_note_8') ): ?>
            <div class="editors_note">
              <?php the_field('add_editors_note_8'); ?>
            </div>
          <?php endif; ?>
          <?php if( get_field('add_editors_note_9') ): ?>
            <div class="editors_note">
              <?php the_field('add_editors_note_9'); ?>
            </div>
          <?php endif; ?>
          <?php if( get_field('add_editors_note_10') ): ?>
            <div class="editors_note">
              <?php the_field('add_editors_note_10'); ?>
            </div>
          <?php endif; ?>
          <?php if( get_field('add_editors_note_11') ): ?>
            <div class="editors_note">
              <?php the_field('add_editors_note_11'); ?>
            </div>
          <?php endif; ?>
          <?php if( get_field('add_editors_note_12') ): ?>
            <div class="editors_note">
              <?php the_field('add_editors_note_12'); ?>
            </div>
          <?php endif; ?>
          <?php if( get_field('add_editors_note_13') ): ?>
            <div class="editors_note">
              <?php the_field('add_editors_note_13'); ?>
            </div>
          <?php endif; ?>
          <?php if( get_field('add_editors_note_14') ): ?>
            <div class="editors_note">
              <?php the_field('add_editors_note_14'); ?>
            </div>
          <?php endif; ?>
          <?php if( get_field('add_editors_note_15') ): ?>
            <div class="editors_note">
              <?php the_field('add_editors_note_15'); ?>
            </div>
          <?php endif; ?>
          <?php if( get_field('add_editors_note_16') ): ?>
            <div class="editors_note">
              <?php the_field('add_editors_note_16'); ?>
            </div>
          <?php endif; ?>
          <?php if( get_field('add_editors_note_17') ): ?>
            <div class="editors_note">
              <?php the_field('add_editors_note_17'); ?>
            </div>
          <?php endif; ?>
          <?php if( get_field('add_editors_note_18') ): ?>
            <div class="editors_note">
              <?php the_field('add_editors_note_18'); ?>
            </div>
          <?php endif; ?>
          <?php if( get_field('add_editors_note_19') ): ?>
            <div class="editors_note">
              <?php the_field('add_editors_note_19'); ?>
            </div>
          <?php endif; ?>
          <?php if( get_field('add_editors_note_20') ): ?>
            <div class="editors_note">
              <?php the_field('add_editors_note_20'); ?>
            </div>
          <?php endif; ?>
        </div>

				<?php get_template_part( 'post-data', get_post_type() ); ?>

				<?php responsive_entry_bottom(); ?>
			</div><!-- end of #post-<?php the_ID(); ?> -->
			<?php responsive_entry_after(); ?>

			<?php responsive_comments_before(); ?>
			<?php comments_template( '', true ); ?>
			<?php responsive_comments_after(); ?>

		<?php
		endwhile;

		get_template_part( 'loop-nav', get_post_type() );

	else :

		get_template_part( 'loop-no-posts', get_post_type() );

	endif;
	?>

</div><!-- end of #content-full -->
</div>
<?php get_footer(); ?>
