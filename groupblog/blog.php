	<?php do_action( 'template_notices' ) // (error/success feedback) ?>
	
	<?php if ( bp_has_groups() ) : while ( bp_groups() ) : bp_the_group(); ?>
	
	<div class="left-menu">
		<?php load_template( TEMPLATEPATH . '/groups/single/menu.php' ) ?>
	</div>

	<div class="main-column">
		<div class="inner-tube">
			
			<div id="group-name">
				<h1><a href="<?php bp_group_permalink() ?>"><?php bp_group_name() ?></a></h1>
				<p class="status"><?php bp_group_type() ?></p>
			</div>

			<?php if ( bp_group_is_visible() && bp_groupblog_is_blog_enabled ( bp_group_id(false) ) ) : ?>

				<?php switch_to_blog( get_groupblog_blog_id() ); ?>			
		
				<div class="bp-widget">
				
					<h4><?php _e( 'Blog Pages', 'buddypress' ); ?></h4>
					           
					<?php $current = $post->ID; ?> 
	  			<?php $nav_query = new WP_Query( 'post_type=page&showposts=-1' );	?>
	
	          <div id="groupblog-pages">
	            	
							<ul id="groupblog-page-list">	
							
							<?php while ( $nav_query->have_posts() ) : $nav_query->the_post(); ?>
							
					    	<li><a href="<?php echo get_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></li>
					    	
							<?php endwhile;?>
							
							</ul>
					  
					  </div>
					  
				</div>
	   
				<div class="bp-widget">
				
					<h4><?php _e( 'Blog Posts', 'buddypress' ); ?></h4>
					           
				  <?php query_posts( 'showposts=5' );	?>
				
					<?php if ( have_posts() ) : ?>
					
						<ul id="groupblog-post-list" class="item-list">	
						
						<?php while ( have_posts() ) : the_post(); ?>
						
				    	<li>
								<div class="blog-post-metadata">
									<?php echo bp_core_get_avatar ( $post->post_author, 1 ); ?>
								  <h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
					        <?php the_time('F j, Y') ?> <?php _e( 'in', 'buddypress' ) ?> <?php the_category(', '); ?> <?php printf( __( 'by %s', 'buddypress' ), bp_core_get_userlink( $post->post_author ) ) ?> <?php edit_post_link('[Edit]', '<span>', '</span>'); ?>
								</div>
					      
					      <div class="blog-post-content">
					        <?php the_excerpt() ?>
					      </div>
					      
								<p class="blog-post-footer">
									<?php if ( the_tags() ) : ?>
										<?php _e( 'Tags: ', 'buddypress' ); ?><?php the_tags( '<span class="tags">', ', ', '</span>' ); ?>
									<?php endif; ?>
									<span class="comments">
										<a href="<?php the_permalink(); ?>#comments"><?php comments_number( __( 'No Comments', 'buddypress' ), __( '1 Comment', 'buddypress' ), __( '% Comments', 'buddypress' ) ); ?> &raquo;</a>
									</span>
								</p>				
							</li>
							
						<?php endwhile;?>
						
						</ul>
					
					<?php else: ?>
					
						<div id="message" class="info">
							<p><?php _e( 'No posts have been made yet to this group blog.', 'buddypress' ); ?></p>
						</div>
						
					<?php endif;?>
						
				</div>
				
				<?php restore_current_blog(); ?>
						
			<?php endif;?>
							
		</div>
		
	</div>
	
	<?php endwhile; endif; ?>