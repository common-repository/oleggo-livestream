<div class="wrap">
	<div id="icon-options-general" class="icon32"></div>
	<h2>Oleggo LiveStream Settings</h2>
	
	<form method="post" action="options.php">
	  
	  <?php wp_nonce_field('update-options'); ?>
      
	  <h3>Video Streaming</h3>
	  
	  <table class="form-table">
	    
		<tr valign="top">
          <th scope="row">Video Streaming Active</th>
          <td>
            <input type="checkbox" name="video_active" value="true" <?php if ( get_option('video_active') == 'true' ) echo ' checked="checked" '; ?> />
	      </td>
        </tr>
		
		<tr valign="top">
          <th scope="row">Embed Video Code</th>
          <td>
		    <textarea name="video_embed" style="width:300px;height:60px;"><?php echo get_option('video_embed'); ?></textarea>
			<br/>
	        <span class="description">Insert your video embed here. (ustream.tv, youtube.com, vimeo.com)</span>
	      </td>
        </tr>	
      
	  </table>	
	  
	  <h3>Twitter Search</h3>
	  
	  <table class="form-table">
	    
		<tr valign="top">
          <th scope="row">Twitter Active</th>
          <td>
            <input type="checkbox" name="twitter_active" value="true" <?php if ( get_option('twitter_active') == 'true' ) echo ' checked="checked" '; ?> />
	      </td>
        </tr>
		
		<tr valign="top">
          <th scope="row">Twitter Search</th>
          <td>
		    <input type="text" name="twitter_search" value="<?php echo get_option('twitter_search'); ?>" />
			<br/>
	        <span class="description">Insert a twitter search. For advanced searching look <a target="_blank" href="http://search.twitter.com/operators">here</a>.</span>
	      </td>
        </tr>	

				
		<tr valign="top">
          <th scope="row">Refresh Rate (in Seconds)</th>
          <td>
		    <input type="text" name="twitter_refresh" value="<?php echo get_option('twitter_refresh'); ?>" />
	      </td>
        </tr>	
		
				
		<tr valign="top">
          <th scope="row">Twitter Box Width</th>
          <td>
		    <input type="text" name="twitter_width" value="<?php echo get_option('twitter_width'); ?>" />
	      </td>
        </tr>	
				
		<tr valign="top">
          <th scope="row">Twitter Box Height</th>
          <td>
		    <input type="text" name="twitter_height" value="<?php echo get_option('twitter_height'); ?>" />
	      </td>
        </tr>	
	
		<tr valign="top">
          <th scope="row">Tweet Begining Text</th>
          <td>
		    <input type="text" name="twitter_tweetbegin" value="<?php echo get_option('twitter_tweetbegin'); ?>" />
			<br/>
	        <span class="description">The beggining text for new tweets. (eg.: "In #EventLiveStream ...") </span>
	      </td>
        </tr>		
		
	  </table>		
	  
	  <h3>Facebook Connect</h3>
	  
	  <table class="form-table">
	  
	    <tr valign="top">
          <th scope="row">Facebook Connect Active</th>
          <td>
            <input type="checkbox" name="facebook_active" value="true" <?php if ( get_option('facebook_active') == 'true' ) echo ' checked="checked" '; ?> />
	      </td>
        </tr>
	  
        <tr valign="top">
          <th scope="row">Facebook App Id</th>
          <td>
		    <input type="text" name="facebook_app_id" value="<?php echo get_option('facebook_app_id'); ?>" />
			<br/>
	        <span class="description">Get your <b>Application ID</b> from Facebook following the <a target="_blank" href="http://wiki.developers.facebook.com/index.php/Live_Stream_Box#Adding_a_Live_Stream_Box_to_Your_Site_or_IFrame_Application">Adding a Live Stream Box to Your Site or IFrame Application</a> steps. You only need to do these 6 steps, nothing else of that page.<br/>Note that creating a new application may take <b>several minutes</b> to propagate to all servers.</span>
	      </td>
        </tr>
		
		<tr valign="top">
          <th scope="row">Facebook Event Name</th>
          <td>
		    <input type="text" name="facebook_xid" value="<?php echo get_option('facebook_xid'); ?>" />
			<br/>
			<span class="description">Select a unique event name for your Application ID. You can use many events with only 1 Application ID.</span>
	      </td>
        </tr>		
		
		<tr valign="top">
          <th scope="row">Facebook Box Width</th>
          <td>
		    <input type="text" name="facebook_box_width" value="<?php echo get_option('facebook_box_width'); ?>" />
	      </td>
        </tr>	
		
		<tr valign="top">
          <th scope="row">Facebook Box Height</th>
          <td>
		    <input type="text" name="facebook_box_height" value="<?php echo get_option('facebook_box_height'); ?>" />
	      </td>
        </tr>
	  
	  </table>
	  <input type="hidden" name="action" value="update" />
	  <input type="hidden" name="page_options" value="video_active, video_embed, twitter_active, twitter_search, twitter_refresh, twitter_width, twitter_height, twitter_tweetbegin, facebook_app_id, facebook_xid, facebook_box_height, facebook_box_width, facebook_active" />
      
	  <?php settings_fields( 'oleggo-settings' ); ?>
	  <p><br/><b>* Note:</b> Place the text "<b>[oleggo-livestream]</b>" (without cuotes) inside a post or a page to see the livestreaming boxes.</p>
	  <p class="submit">
        <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
      </p>
	  
	  
	</form>
</div>