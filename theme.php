<?php
/**
 * Portfolio Habari Theme
 * by Konzertheld
 * http://konzertheld.de
 */
 
class Portfolio extends Theme
{	
	/**
	 * Execute on theme init to apply these filters to output
	 */
	public function action_init_theme()
	{
		Format::apply('autop', 'comment_content_out');
	}
		
	/**
	 * Create theme options
	 */
	public function action_theme_ui( $theme )
	{
		
	}
	
	public function action_template_header($theme)
	{
		Stack::add('template_header_javascript', Site::get_url('scripts') . '/jquery.js', 'jquery');
		// if photoset content type exists
		Stack::add('template_header_javascript', $theme->get_url() . '/photoset.js', 'photoset-js', 'jquery');
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
	 * @todo this should be done with TermFormat now
	 * @param array $array The Tags object from a Post object
	 * @return string The HTML of the linked tags
	 */
	public function filter_post_tags_out($array)
	{
		foreach($array as $tag) $array_out[] = "<li><a href='" . URL::get("display_entries_by_tag", array( "tag" => $tag->term) ) . "' rel='tag'>" . $tag->term_display . "</a></li>\n";
		$out = '<ul>' . implode('', $array_out) . '</ul>';
		return $out;
 	}
	
	/**
	 * Provide excerpts to avoid cutting off text when no summary is provided
	 **/
	public function filter_post_content_excerpt($text)
	{
		if(strlen($text) > 280) {
			// cut off everything after the word at position 280. Don't use \W so we don't cut HTML tags
			$rest = preg_replace('/[ .\-]+.*/', '', substr($text, 280));
			return substr($text, 0, 280) . $rest;
		}
		return $text;
		
		// Alternative method: Return match[0] from /(\w+\W+){50}/ for the first 50 words
	}
}
?>