<?php
/*
Section: Contact Bar
Author: Enrique Chavez
Author URI: http://tmeister.net
Version: 1.0
Description: Inline Description
Class Name: SOContactBar
Filter: full-width
V3: true
*/

/*
 * PageLines Headers API
 *
 *  Sections support standard WP file headers (http://codex.wordpress.org/File_Header) with these additions:
 *  -----------------------------------
 * 	 - Section: The name of your section.
 *	 - Class Name: Name of the section class goes here, has to match the class extending PageLinesSection.
 *	 - Cloning: (bool) Enable cloning features.
 *	 - Depends: If your section needs another section loaded first set its classname here.
 *	 - Workswith: Comma seperated list of template areas the section is allowed in.
 *	 - Failswith: Comma seperated list of template areas the section is NOT allowed in.
 *	 - Demo: Use this to point to a demo for this product.
 *	 - External: Use this to point to an external overview of the product
 *	 - Long: Add a full description, used on the actual store page on http://www.pagelines.com/store/
 *
 */

class SOContactBar extends PageLinesSection {

	var $domain = 'tm_contact_bar';

	function section_persistent(){
	}
	function section_head(){}

	function section_styles(){
		wp_enqueue_script( 'contact-bar', $this->base_url . '/js/cbar.js', array( 'jquery' ), '1.0', true );
	}

 	function section_template()
 	{
		$first_icon = $this->opt( 'tm_cb_first_icon' ) ? $this->opt( 'tm_cb_first_icon' ) : 'icon-th';
		$first_info = $this->opt( 'tm_cb_first_label') ? $this->opt( 'tm_cb_first_label') : 'Call Us: (001) 030-234-567-890';
		$sec_icon   = $this->opt( 'tm_cb_sec_icon' ) ? $this->opt( 'tm_cb_sec_icon' ) : 'icon-envelope';
		$sec_info   = $this->opt( 'tm_cb_sec_label') ? $this->opt( 'tm_cb_sec_label') : 'your@email.com';
		$socials    = array();
		foreach ($this->get_valid_social_sites() as $key => $social) {
			if( $this->opt( $social . '-url' ) ){
				array_push($socials, array('site' => $social, 'url' => $this->opt( $social . '-url' )));
			}
		}
 	?>
		<div class="pl-content">
			<div class="row cb-container">
				<div class="span3 cb-first-row">
					<div class="cb-holder">
						<i class="icon icon-<?php echo $first_icon ?>">
							<span data-sync="tm_cb_first_label"><?php echo $first_info ?></span>
						</i>
					</div>
				</div>
				<div class="span3 cb-second-row">
					<div class="cb-holder">
						<i class="icon icon-<?php echo $sec_icon ?>">
							<span data-sync="tm_cb_sec_label"><?php echo $sec_info ?></span>
						</i>
					</div>
				</div>
				<div class="span6 cb-icons">
					<div class="social-holder">
						<ul class="cb-menu">
							<?php foreach ($socials as $social): ?>
								<li class="<?php echo $social['site'] ?>">
									<a href="<?php echo $social['url'] ?>" title="<?php echo ucfirst($social['site']) ?>" target="_blank"></a>
								</li>
							<?php endforeach ?>
						</ul>
						<div class="clear"></div>
					</div>
				</div>
			</div>
		</div>
	<?php
 	}

 	function section_opts()
	{
		$opts = array(
			array(
				'key' => 'tm_cb_phone',
				'type' => 'multi',
				'title'			=> __('Left Information Box', $this->domain),
				'shortexp'		=> __('Please fill the follow fields.', $this->domain),
				'opts' => array(
					array(
						'key' => 'tm_cb_first_icon',
						'label'   	=> __( 'Select the icon to show beside the text - Icons Preview <a target="_blank" href="http://twitter.github.com/bootstrap/base-css.html#icons">bootstrap site.</a>', $this->domain ),
						'type'         	=> 'select_icon'
					),
					array(
						'key' => 'tm_cb_first_label',
 						'type' => 'text',
						'label' 	=> __( 'Enter the information to show in the information text, eg. "Call Us: (001) 030-234-567-890"', $this->domain ),
					),
				)
			),
			array(
				'key' => 'tm_cb_email',
				'type' => 'multi',
				'title'			=> __('Right Information Box', $this->domain),
				'shortexp'		=> __('Please fill the follow fields.', $this->domain),
				'opts' => array(
					array(
						'key' => 'tm_cb_sec_icon',
						'label'   	=> __( 'Select the icon to show beside the text - Icons Preview <a target="_blank" href="http://twitter.github.com/bootstrap/base-css.html#icons">bootstrap site.</a>', $this->domain ),
						'type'         	=> 'select_icon'
					),
					array(
						'key' => 'tm_cb_sec_label',
 						'type' => 'text',
						'label' 	=> __( 'Enter the information to show in the information text, eg. "youremail@domain.com"', $this->domain ),
					),
				)
			),
			array(
				'key' => 'tm_cb_social',
				'type'			=> 'multi',
				'title'			=> __('Social Sites URL', $this->domain),
				'label'		=> __('In the follow fields please, enter the social URL, if the URL field is empty, nothing will show.', $this->domain),
				'opts'	=> $this->get_social_fields()
			),
		);
		return $opts;
	}


	function get_social_fields()
	{
		$out = array();
		foreach ($this->get_valid_social_sites() as $social => $name)
		{
			$out[$name . '-url'] = array(
				'key' => $name . '-url',
				'label' => __(ucfirst($name)),
				'type' => 'text'
			);
		}
		return $out;
	}

	function get_valid_social_sites()
	{
		return array("digg","dribbble","facebook","flickr","forrst","googleplus","html5","lastfm","linkedin","paypal","picasa","pinterest","rss","skype","stumbleupon","tumblr","twitter","vimeo","wordpress","yahoo","youtube","behance","instagram"
		);
	}


} /* End of section class - No closing php tag needed */