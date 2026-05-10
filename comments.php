<?php
/**
 * Comments Template
 */
if ( post_password_required() ) {
    echo '<p class="nocomments">' . esc_html__( 'این پست محافظت شده است. برای مشاهده نظرات رمز عبور وارد کنید.', 'persian-atheists' ) . '</p>';
    return;
}
?>

<div id="comments" class="comments-area">

    <?php if ( have_comments() ) : ?>
        <h2 class="comments-title section-title">
            💬 <?php
            $count = get_comments_number();
            printf( _n( '%s نظر', '%s نظر', $count, 'persian-atheists' ), number_format_i18n($count) );
            ?>
        </h2>

        <ol class="comment-list" style="list-style:none;padding:0;">
            <?php
            wp_list_comments([
                'style'       => 'ol',
                'short_ping'  => true,
                'avatar_size' => 44,
                'callback'    => 'pa_comment_template',
            ]);
            ?>
        </ol>

        <?php the_comments_pagination([
            'prev_text' => '← قبلی',
            'next_text' => 'بعدی →',
        ]); ?>

    <?php endif; ?>

    <?php if ( ! comments_open() && get_comments_number() && post_type_supports(get_post_type(), 'comments') ) : ?>
        <p class="no-comments" style="color:var(--muted);text-align:center;padding:20px;">
            <?php esc_html_e( 'نظرات بسته شده‌اند.', 'persian-atheists' ); ?>
        </p>
    <?php endif; ?>

    <?php
    comment_form([
        'title_reply'          => '<span id="reply-title" class="comment-reply-title" style="font-size:var(--h3);font-weight:700;">✏️ ' . esc_html__( 'ارسال نظر', 'persian-atheists' ) . '</span>',
        'title_reply_before'   => '<h2 id="reply-title" class="comment-reply-title" style="font-size:20px;font-weight:800;margin-bottom:20px;">',
        'title_reply_after'    => '</h2>',
        'comment_notes_before' => '<p style="font-size:13px;color:var(--muted);margin-bottom:16px;">' . esc_html__( 'ایمیل شما منتشر نمی‌شود. فیلدهای الزامی علامت‌گذاری شده‌اند.', 'persian-atheists' ) . '</p>',
        'fields' => [
            'author' => '<div class="form-group"><label class="form-label" for="author">نام <span class="required" style="color:#ef4444;">*</span></label><input id="author" name="author" type="text" class="form-control" required></div>',
            'email'  => '<div class="form-group"><label class="form-label" for="email">ایمیل <span class="required" style="color:#ef4444;">*</span></label><input id="email" name="email" type="email" class="form-control" required></div>',
            'url'    => '<div class="form-group"><label class="form-label" for="url">وب‌سایت</label><input id="url" name="url" type="url" class="form-control"></div>',
        ],
        'comment_field' => '<div class="form-group"><label class="form-label" for="comment">نظر <span class="required" style="color:#ef4444;">*</span></label><textarea id="comment" name="comment" class="form-control" rows="5" required></textarea></div>',
        'submit_button' => '<button type="submit" class="btn btn-primary">💬 ارسال نظر</button>',
        'submit_field'  => '<div class="form-group" style="margin-top:8px;">%1$s %2$s</div>',
        'class_form'    => 'comment-form',
    ]);
    ?>

</div>

<?php
/**
 * Custom comment template callback
 */
function pa_comment_template( $comment, $args, $depth ) {
    $GLOBALS['comment'] = $comment;
    ?>
    <li id="comment-<?php comment_ID(); ?>" <?php comment_class('comment-item', $comment); ?> style="margin-bottom:24px;">
        <div style="display:flex;gap:14px;padding:20px;background:var(--surface);border:1px solid var(--border);border-radius:var(--radius);">

            <div style="flex-shrink:0;">
                <?php echo get_avatar( $comment, 44, '', '', [ 'class' => '', 'style' => 'border-radius:50%;' ] ); ?>
            </div>

            <div style="flex:1;min-width:0;">
                <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:8px;margin-bottom:10px;">
                    <div>
                        <span style="font-weight:700;font-size:14px;color:var(--text);"><?php comment_author(); ?></span>
                        <span style="color:var(--muted);font-size:12px;margin-right:8px;">·</span>
                        <time style="font-size:12px;color:var(--muted);" datetime="<?php comment_time('c'); ?>"><?php comment_date('j F Y'); ?></time>
                    </div>
                    <?php comment_reply_link( array_merge( $args, [
                        'depth'     => $depth,
                        'max_depth' => $args['max_depth'],
                        'before'    => '<span style="font-size:12px;">',
                        'after'     => '</span>',
                    ] ) ); ?>
                </div>

                <?php if ( '0' == $comment->comment_approved ) : ?>
                    <p style="color:var(--accent);font-size:13px;">⏳ نظر شما در انتظار تأیید است.</p>
                <?php endif; ?>

                <div class="comment-content" style="font-size:14px;color:var(--text);line-height:1.75;">
                    <?php comment_text(); ?>
                </div>
            </div>

        </div>
    </li>
    <?php
}
