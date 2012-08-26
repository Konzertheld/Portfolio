<?php
/**
 * Portfolio Habari Theme
 * by Konzertheld
 * http://konzertheld.de
 */

 // TODO: Deactivate content type on deactivation
 
class Portfolio extends Theme
{	
	/**
	 * Call initialization on theme activation.
	 */
	public function action_theme_activated()
	{
		Post::add_new_type( 'image' );
		// Give anonymous users access
		$group = UserGroup::get_by_name( 'anonymous' );
		$group->grant( 'post_image', 'read');
	}
	
	/**
	 * Execute on theme init to apply these filters to output
	 */
	public function action_init_theme()
	{
		Format::apply('autop', 'comment_content_out');
		$this->load_text_domain('TheViewInside');
	}
	
	public function action_form_publish($form, $post, $context)
	{
		$form->insert('tags', 'text', 'thumbnail_url', 'null:null', _t('Thumbnail URL'), 'admincontrol_textArea');
		$form->thumbnail_url->value = $post->info->thumbnail_url;
		$form->thumbnail_url->template = 'admincontrol_text';
		$form->insert('tags', 'text', 'fullsize_url', 'null:null', _t('Fullsize URL'), 'admincontrol_textArea');
		$form->fullsize_url->value = $post->info->fullsize_url;
		$form->fullsize_url->template = 'admincontrol_text';
	}
	
	public function action_publish_post( $post, $form )
	{
		$post->info->thumbnail_url = $form->thumbnail_url->value;
		$post->info->fullsize_url = $form->fullsize_url->value;
	}
	
	public function action_admin_header($theme)
	{

	}
	
	/**
	 * Create theme options
	 */
	public function action_theme_ui( $theme )
	{
		
	}
	
	/**
	 * Redirect to the theme admin to force a full reload
	 * Required for the generated text fields to update
	 */
	function options_callback($form)
	{
		
	}

	/**
	 * Add some variables to the template output
	 */
	public function action_add_template_vars()
	{
		$this->assign( 'multipleview', false);
		$action = Controller::get_action();
		if ($action == 'display_home' || $action == 'display_entries' || $action == 'search' || $action == 'display_tag' || $action == 'display_date') {
			$this->assign('multipleview', true);
		}
	}

	/**
	 * Convert a post's tags ArrayObject into a usable list of links
	 *
	 * @param array $array The Tags object from a Post object
	 * @return string The HTML of the linked tags
	 */
	public function filter_post_tags_out($array)
	{
		foreach($array as $tag) $array_out[] = "<li><a href='" . URL::get("display_entries_by_tag", array( "tag" => $tag->term) ) . "' rel='tag'>" . $tag->term_display . "</a></li>\n";
		$out = '<ul>' . implode('', $array_out) . '</ul>';
		return $out;
 	}
	
	public function filter_post_title_out($title, $post)
	{
		if(isset($post->info->thumbnail_url))
		{
			return "<img src='" . $post->info->thumbnail_url . "' alt='$title' title='$title'>";
		}
		else
		{
			return $title;
		}
	}
	
	public function filter_post_type_display($type, $foruse) 
	{ 
	  $names = array( 
		'image' => array(
		  'singular' => _t('Image'),
		  'plural' => _t('Images'),
		)
	  ); 
	  return isset($names[$type][$foruse]) ? $names[$type][$foruse] : $type; 
	}
	
	public function filter_template_user_filters($filters) {
	  if ( isset($filters['content_type']) )
	  {
		$filters['content_type'] = Utils::single_array( $filters['content_type'] );
		$filters['content_type'][] = Post::type('image');
		$filters['content_type'][] = Post::type('blogroll');
	  }
	  return $filters;
	}
}
?>