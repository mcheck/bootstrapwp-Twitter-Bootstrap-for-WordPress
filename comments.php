<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback to bootstrapwp_comment() which is
 * located in the functions.php file.
 *
 * @package WordPress
 * @subpackage WP-Bootstrap
 * @since WP-Bootstrap 0.1
 *
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if (post_password_required()) {
    return;
}
?>
<div id="comments" class="comments-area">

    <?php if (have_comments()) : ?>
    <h2 id="comments-title">
        <?php
        printf(
            _n(
                'One thought on &ldquo;%2$s&rdquo;',
                '%1$s thoughts on &ldquo;%2$s&rdquo;',
                get_comments_number(),
                'bootstrapwp'
            ),
            number_format_i18n(get_comments_number()),
            '<span>' . get_the_title() . '</span>'
        );
        ?>
    </h2>

    <ul class="commentlist media-list">
        <?php
        wp_list_comments(array('callback' => 'bootstrapwp_comment'));
        ?>
    </ul><!-- /.commentlist -->
    <?php if (get_comment_pages_count() > 1 && get_option(
        'page_comments'
    )
    ) : // are there comments to navigate through ?>
        <nav id="comment-nav-below" class="navigation" role="navigation">
            <h1 class="assistive-text section-heading"><?php _e('Comment navigation', 'minimallybaked'); ?></h1>

            <div class="nav-previous"><?php previous_comments_link(
                __('&larr; Older Comments', 'minimallybaked')
            ); ?></div>
            <div class="nav-next"><?php next_comments_link(__('Newer Comments &rarr;', 'minimallybaked')); ?></div>
        </nav>
        <?php endif; // check for comment navigation ?>

    <?php /* If there are no comments and comments are closed, let's leave a little note, shall we?
		 * But we don't want the note on pages or post types that do not support comments.
		 */
elseif (!comments_open() && '0' != get_comments_number() && post_type_supports(get_post_type(), 'comments')) :
    ?>
    <p class="nocomments"><?php _e('Comments are closed.', 'bootstrapwp'); ?></p>
    <?php endif; ?>

    <?php comment_form(); ?>

</div><!-- #comments .comments-area -->