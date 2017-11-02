<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$field_groups = beyondcitation_field_groups();
$bc_fields = bc_get_database_fields();

/**
 * Database template.
 */

get_header(); ?>
<div id="content-outer">
<div id="content-full" class="grid col-940">

	<?php if ( have_posts() ) : ?>

		<?php while ( have_posts() ) : the_post(); ?>

			<?php responsive_entry_before(); ?>
			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<?php responsive_entry_top(); ?>

				<?php get_template_part( 'post-meta', get_post_type() ); ?>

				<div class="post-entry">
					<?php the_excerpt(); ?>
				</div>
				<!-- end of .post-entry -->

				<div class="db-data">
					<nav class="db-tabs">
						<ul>
						<?php foreach ( $field_groups as $field_group_slug => $field_group ) : ?>
							<li class="db-tab db-tab-<?php echo esc_attr( $field_group_slug ); ?>" id="db-tab-<?php echo esc_attr( $field_group_slug ); ?>" data-field-group="<?php echo esc_attr( $field_group_slug ); ?>">
								<a href="#<?php echo esc_html( $field_group_slug ); ?>"><?php echo esc_html( $field_group['title'] ); ?></a>
							</li>
						<?php endforeach; ?>
						</ul>
					</nav>

					<div class="db-field-groups">
						<?php foreach ( $field_groups as $field_group_slug => $field_group ) : ?>
							<a name="<?php echo esc_attr( $field_group_slug ); ?>">&nbsp;</a>
							<h2 class="db-field-group-header"><?php echo esc_html( $field_group['title'] ); ?></h2>
							<div class="db-field-group db-field-groups-<?php echo esc_attr( $field_group_slug ); ?>" id="db-field-group-<?php echo esc_attr( $field_group_slug ); ?>" data-field-group="<?php echo esc_attr( $field_group_slug ); ?>">
								<?php foreach ( $field_group['fields'] as $field_slug ) : ?>
									<?php get_template_part( 'db-field', $field_slug ); ?>
								<?php endforeach; ?>
							</div>
						<?php endforeach; ?>
					</div>
				</div>

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
