<?php
/**
 * Template part for displaying connect module
 *
 * contact area
 * social media area
 * tweet
 * used only with ACF, templates using Visual Composer, please see code in that plugin
 * $get_this comes from banner.php 
 * 
 * footer.php
 * 
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Conduent
 */

?>

<?php

  $connect_data = array();
  
  if(function_exists('cdu_connect_get_fields')) {
    $connect_data = cdu_connect_get_fields();
  }
  if (false) {
	  echo "<PRE>";
	  print_r($connect_data);
	  echo "</PRE>";
	}
	
 ?>
<?php if(!empty($connect_data)): ?>
  <section id="connect-footer" class="container-fluid cwf-padding-top-sm-48 cwf-padding-top-xs-32 dark-gray-bg" data-connect-module="<?php echo $connect_data['title']; ?>">
    <div class="container">
      <div class="row">

        <?php if(isset($connect_data['contact_link_text']) || isset($connect_data['contact_number']) ): ?>
        <div class="col-md-3 col-sm-4 cwf-padding-bottom-32 contact">
          <h6 class="white-text hidden-xs text-center cwf-margin-bottom-0 cwf-padding-bottom-16">Connect with an expert</h6>

          <?php if(strlen($connect_data['contact_number']) > 5): ?>					
          <a href="tel:<?php echo $connect_data['contact_number']; ?>" class="btn btn-teal-border btn-full btn-block text-uppercase cwf-margin-bottom-16"><sub class="i-cwf-customer-service-icon"></sub><span><?php echo $connect_data['contact_number']; ?></span></a>
          <?php endif; ?>
          <?php if(isset($connect_data['contact_link_text']) && is_numeric($connect_data['contact_link_url'])): ?>
            <button id="footer-connect-contact-us" type="button" class="btn btn-teal-border btn-full btn-block text-uppercase"><sub class="i-cwf-form-icon"></sub><span><?php echo $connect_data['contact_link_text']; ?></span></button>
          <?php endif; ?>
          <?php if(isset($connect_data['contact_link_text']) && !is_numeric($connect_data['contact_link_url'])): ?>					
          <a target="<?php echo $connect_data['contact_link_target']; ?>" href="<?php echo $connect_data['contact_link_url']; ?>" class="btn btn-teal-border btn-full btn-block text-uppercase cwf-margin-bottom-16"><sub class="i-cwf-form-icon"></sub><span><?php echo $connect_data['contact_link_text']; ?></span></a>
          <?php endif; ?>
        </div>
        <?php endif; ?>

        <div class="col-md-8 col-md-offset-1 col-sm-6 col-sm-offset-2 tablet-group">
        <?php if(!empty($connect_data['social_media'])): ?>
        <div class="col-md-5 col-sm-12 tweet cwf-padding-bottom-32">
        <div class="cdu_social_feed" data-handles-default="<?php echo $connect_data['social_media'] ?>">
        </div>
        <script id="feed-tmpl-js" type="text/x-jsrender">
          {{if header}}
          <div class="col-md-12 cwf-padding-bottom-16 visible-md-block visible-lg-block text-uppercase">
            <h6 class="white-text cwf-margin-bottom-0">{{:header_text}}</h6>
          </div>
          {{/if}}
          {{if twitter}}
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="feed-tweet" data-index="{{:index}}">
                <div class="text-side">
                  <p class="account">
                    <a href="{{:account_link}}" target="_blank">{{:account}}</a>
                    <span>&#8226;</span>
                    <a target="_blank" href="{{:account_link}}">{{:time_ago}}</a>
                  </p>
                  <p class="tweet-text">{{:title}}</p>
                  <div class="twitter-actions">
                    <a class="reply" target="_blank" href="https://twitter.com/intent/tweet?in_reply_to={{:native_id}}">Reply</a>
                    <a class="retweet" target="_blank" href="https://twitter.com/intent/retweet?tweet_id={{:native_id}}">Retweet</a>
                    <a class="favorite" target="_blank" href="https://twitter.com/intent/favorite?tweet_id={{:native_id}}">Favorite</a>
                  </div>
                </div>
              </div>
            </div>
          {{/if}}

          {{if linkedin}}
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="feed-linkedin">
              <div class="text-side">
                <p class="account">
                  <a href="{{:account_link}}" target="_blank">{{:account}}</a>
                </p>
                <p class="title">
                  <a href="{{:link}}" target="_blank" name="&lid=connect-social-linkedin-title text">{{:title}}</a>
                </p>
                <p class="li-info">{{:time_ago}}</p>
              </div>
            </div>
          </div>

          {{/if}}
          {{if facebook}}
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="feed-facebook">
              <div class="text-side">
                <p class="account">
                  <a href="{{:account_link}}" target="_blank">{{:account}}</a>
                  <span>&#8226;</span>
                  <span>{{:time_ago}}</span>
                </p>
                <p class="title"> {{:title}} </p>
              </div>
            </div>
          </div>
          {{/if}}
      </script>
      
        <div class="clearfix"></div>
        </div>
        <div class="col-xs-12 col-sm-12 cwf-padding-left-0 cwf-padding-right-0 visible-xs-block">
          <hr class="med-gray no-top-margin no-bottom-margin  ">
        </div>			
        <?php endif; ?>

        <div class="col-md-4 col-md-offset-1 col-sm-12 col-sm-offset-0 cwf-padding-bottom-32 follow">
          <div class="col-md-12 cwf-padding-top-32 visible-xs-block"></div>
          <div class="col-md-12 cwf-padding-bottom-16 visible-md-block visible-lg-block text-uppercase">
            <h6 class="white-text cwf-margin-bottom-0">Follow</h6>
          </div>
          <?php if($connect_data["facebook_url"] != ""): ?>	
          <div class="social-icon">
            <a class="social" target="_blank" href="<?php echo $connect_data["facebook_url"]; ?>"><div class="white-text i-cwf-fb-icon"></div></a>
          </div>
          <?php endif; ?>
          <?php if($connect_data["twitter_url"] != ""): ?>	
          <div class="social-icon">
            <a class="social" target="_blank" href="<?php echo $connect_data["twitter_url"]; ?>"><div class="white-text i-cwf-twitter-icon"></div></a>
          </div>
          <?php endif; ?>
          <?php if($connect_data["linkedin_url"] != ""): ?>	
          <div class="social-icon">
            <a class="social" target="_blank" href="<?php echo $connect_data["linkedin_url"]; ?>"><div class="white-text i-cwf-linkedin-icon"></div></a>
          </div>
          <?php endif; ?>
          <?php if($connect_data["youtube_url"] != ""): ?>	
          <div class="social-icon">
            <a class="social" target="_blank" href="<?php echo $connect_data["youtube_url"]; ?>"><div class="white-text i-cwf-youtube-icon"></div></a>
          </div>
          <?php endif; ?>
          <?php if($connect_data["slideshare_url"] != ""): ?>	
          <div class="social-icon">
            <a class="social" target="_blank" href="<?php echo $connect_data["slideshare_url"]; ?>"><div class="white-text i-cwf-slideshare-icon"></div></a>
          </div>
          <?php endif; ?>
          <div class="clearfix"></div>
        </div>

      </div>
      <div class="col-xs-12 ">
        <hr class="med-gray no-top-margin no-bottom-margin">
      </div>

      </div>
    </div>
  </section>

  <?php if(isset($connect_data['contact_link_text']) && is_numeric($connect_data['contact_link_url'])): ?>
    <?php echo apply_filters( 'the_content','[marketo_form form_id="'.$connect_data['contact_link_url'].'" trigger_selector="#footer-connect-contact-us" trigger_type="custom" title="'.$connect_data['contact_link_text'].'"]'); ?>
  <?php endif; ?>
<?php endif; ?>
