<?php
/************* COMMENT LAYOUT *********************/
// Comment Form

    add_filter( 'comment_form_default_fields', 'bootstrap3_comment_form_fields' );
    function bootstrap3_comment_form_fields( $fields ) {
    $commenter = wp_get_current_commenter();
    $req = get_option( 'require_name_email' );
    $aria_req = ( $req ? " aria-required='true'" : '' );
    $html5 = current_theme_supports( 'html5', 'comment-form' ) ? 1 : 0;
    $fields = array(
    'author' => '<div class="form-group comment-form-author label-floating">' . '<label for="author" class="control-label">' . __( 'Name', 'understrap' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
    '<input class="form-control" id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' ></div>',
    'email' => '<div class="form-group comment-form-email label-floating"><label for="email" class="control-label">' . __( 'Email', 'understrap' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
    '<input class="form-control" id="email" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' ></div>',
    'url' => '<div class="form-group comment-form-url label-floating"><label for="url" class="control-label">' . __( 'Website', 'understrap' ) . '</label> ' .
    '<input class="form-control" id="url" name="url" ' . ( $html5 ? 'type="url"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" ></div>',
    );
    return $fields;
    }

    add_filter( 'comment_form_defaults', 'bootstrap3_comment_form' );
    function bootstrap3_comment_form( $args ) {
    $args['comment_field'] = '<div class="form-group comment-form-comment label-floating">
    <label for="comment" class="control-label">' . _x( 'Comment', 'noun', 'understrap' ) . ( ' <span class="required">*</span>' ) . '</label>
    <textarea class="form-control" id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea>
    <p class="help-block">' . __( 'You may use the following HTML-Tags: ', 'understrap' ) . '<br><code>&lt;a href=&quot;&quot; title=&quot;&quot;&gt; &lt;abbr title=&quot;&quot;&gt; &lt;b&gt; &lt;blockquote cite=&quot;&quot;&gt; &lt;cite&gt; &lt;code&gt; &lt;del datetime=&quot;&quot;&gt; &lt;em&gt; &lt;i&gt; &lt;q cite=&quot;&quot;&gt; &lt;s&gt; &lt;strike&gt; &lt;strong&gt;</code></p>
    </div><p>&nbsp;</p>';
	$args['class_submit'] = 'btn btn-lg btn-ghost btn-raised'; // since WP 4.1
    return $args;
    }
