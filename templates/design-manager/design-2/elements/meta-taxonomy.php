<?php global $redux_builder_amp;
	if( isset($redux_builder_amp['ampforwp-tags-single']) && $redux_builder_amp['ampforwp-tags-single']) { ?>
<div class="amp-wp-article-header amp-wp-article-category ampforwp-meta-taxonomy ">
<?php	$ampforwp_tags=  get_the_terms( $this->ID, 'post_tag' );
			if ( $ampforwp_tags && ! is_wp_error( $ampforwp_tags ) ) :?>
		<?php do_action('ampforwp_before_meta_taxonomy_hook',$this); ?>
		<div class="amp-wp-meta amp-wp-tax-tag ampforwp-tax-tag">
				<?php
				//if RTL is OFF
				if(!$redux_builder_amp['amp-rtl-select-option']) {
					printf( esc_attr(ampforwp_translation($redux_builder_amp['amp-translator-tags-text'], 'Tags:' ) .' ' ));
							}

				foreach ($ampforwp_tags as $tag) {
				if( isset($redux_builder_amp['ampforwp-archive-support']) && $redux_builder_amp['ampforwp-archive-support'] && isset($redux_builder_amp['ampforwp-cats-tags-links-single']) && $redux_builder_amp['ampforwp-cats-tags-links-single']) {
					   echo ('<span class="amp-tag-'.esc_attr($tag->term_id).'"><a href="'. ampforwp_url_controller( get_tag_link( $tag->term_id ) ).'" >'.esc_attr($tag->name) .'</a></span>');//#934
          		} else {
                      echo ('<span>'.esc_attr($tag->name) .'</span>');
          			}
				}

				//if RTL is ON
				if($redux_builder_amp['amp-rtl-select-option']) {
					echo '<span class="tt-lb">'.esc_attr( ampforwp_translation($redux_builder_amp['amp-translator-tags-text'], 'Tags:' ) .' ' ).'</span>';
							}
				?>

		</div>
<?php endif;?>
</div> <?php } ?>

<?php

if( array_key_exists( 'amp-author-description' , $redux_builder_amp ) && is_single() ) {
	if( $redux_builder_amp['amp-author-description'] ) { ?>
	<div class="amp-wp-content amp_author_area ampforwp-meta-taxonomy">
	    <div class="amp_author_area_wrapper">
	        <?php $post_author = $this->get( 'post_author' );
	            if ( $post_author ) {
	            	//If Avatar is set up in WP user avatar: grab it
	            	$author_avatar_url = ampforwp_get_wp_user_avatar();
	            	//Else : Get the Gravatar
	            	if($author_avatar_url == null){
	            		$author_avatar_url = get_avatar_url( $post_author->user_email, array( 'size' => 70 ) );
	            	}
	                if ( $author_avatar_url ) { ?>
	                    <amp-img <?php if(ampforwp_get_data_consent()){?>data-block-on-consent <?php } ?> src="<?php echo esc_url($author_avatar_url); ?>" width="70" height="70" layout="fixed"></amp-img>
	                    <?php
	                }
	                echo ampforwp_wp_kses(ampforwp_get_author_details( $post_author , 'meta-taxonomy' ));  
	             	echo  ampforwp_wp_kses($post_author->description); ?>

	        <?php } ?>
	    </div>
	</div> <?php
	}
}

do_action('ampforwp_after_meta_taxonomy_hook',$this);