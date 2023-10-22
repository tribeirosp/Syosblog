<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Munfarid
 * @since 1.0
 * @version 1.0
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php if ( have_comments() ) : ?>

		<h5 class="comment-title pt-15px mb-40px">
			<?php
			printf( _n( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'munfarid' ),
				number_format_i18n( get_comments_number() ), get_the_title() );
			?>
		</h5>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
			<nav id="comment-nav-above" class="navigation comment-navigation">
				<h1 class="screen-reader-text"><?php esc_html__('Comment navigation', 'munfarid' ); ?></h1>

				<div
					class="nav-previous"><?php previous_comments_link( esc_html__('&larr; Older Comments', 'munfarid' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( esc_html__('Newer Comments &rarr;', 'munfarid' ) ); ?></div>
			</nav><!-- #comment-nav-above -->
		<?php endif; // Check for comment navigation. ?>

		<ol class="comment-list">
		<?php
			wp_list_comments(
				array(
					'walker'      => new Munfarid_Comment_Walker(),
					'avatar_size' => 60,
					'short_ping'  => true,
					'style'       => 'ol',
				)
			);
			?>
		</ol><!-- .comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
			<nav id="comment-nav-below" class="navigation comment-navigation">
				<h1 class="screen-reader-text"><?php esc_html__('Comment navigation', 'munfarid' ); ?></h1>

				<div
					class="nav-previous"><?php previous_comments_link( esc_html__('&larr; Older Comments', 'munfarid' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( esc_html__('Newer Comments &rarr;', 'munfarid' ) ); ?></div>
			</nav><!-- #comment-nav-below -->
		<?php endif; // Check for comment navigation. ?>

		<?php if ( ! comments_open() ) : ?>
			<p class="no-comments"><?php esc_html__('Comments are closed.', 'munfarid' ); ?></p>
		<?php endif; ?>

	<?php endif; // have_comments() ?>

	<?php comment_form(); ?>

</div><!-- #comments -->