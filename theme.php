<?php
namespace Habari;
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
		$this->add_template('block.photoset_randomphotos', dirname(__FILE__) . '/block.photoset_randomphotos.php');
		$this->add_template('block.singlepage_content', dirname(__FILE__) . '/block.singlepage_content.php');
		
		Format::apply('autop', 'comment_content_out');
		Format::apply('autop', 'post_content_excerpt');
		
		$this->assign( 'multipleview', false);
		$action = Controller::get_action();
		if ($action == 'display_home' || $action == 'display_entries' || $action == 'search' || $action == 'display_tag' || $action == 'display_date') {
			$this->assign('multipleview', true);
		}
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
		if(!$this->multipleview && array_key_exists('photoset', Post::list_active_post_types())) {
			Stack::add('template_header_javascript', $theme->get_url() . '/photoset.js', 'photoset-js', 'jquery');
		}
	}
	
	/**
	 * Provide some blocks that make using the theme as an actual portfolio easier
	 */
	public function filter_block_list($blocklist = array())
	{
		$blocklist['singlepage_content'] = _t("Statische Seite", __CLASS__);
		if(Post::type('photoset')) {
			$blocklist['photoset_randomphotos'] = _t("Zufällige Fotoauswahl", __CLASS__);
		}
		return $blocklist;
	}
	
	/**
	 * Configuration for the singlepage block
	 */
	public function action_block_form_singlepage_content($form, $block)
	{
		$pageposts = Posts::get(array('content_type' => Post::type('page'), 'status' => Post::status('published')));
		$pages = array();
		foreach($pageposts as $page) {
			$pages[$page->id] = $page->title;
		}
		$form->append( 'select', 'pages', __CLASS__ . '__pageblock_page', _t("Page to display:", __CLASS__));
		$form->pages->size = (count($pages) > 6) ? 6 : count($pages);
		$form->pages->options = $pages;
	}
	
	/**
	 * Configuration for the randomphotos block for the photoset content type
	 * The output will be done in the same style the output for the photo content type
	 */
	public function action_block_form_photoset_randomphotos($form, $block)
	{
		$form->append('text', 'photocount', __CLASS__ . '__randomphotosblock_count', _t("Number of photos to display:", __CLASS__));
	}
	
	/**
	 * Put the selected page into the singlepage block
	 */
	public function action_block_content_singlepage_content($block)
	{
		$block->page = Post::get(array('id' => Options::get(__CLASS__ . '__pageblock_page')));
	}
	
	/**
	 * Get photos from sets and supply them to the block
	 */
	public function action_block_content_photoset_randomphotos($block)
	{
		$assets = array();
		$posts = Posts::get(array('content_type' => Post::type('photoset'), 'status' => Post::status('published')));
		foreach($posts as $post) {
			foreach(explode("\n", $post->content_media) as $asset) {
				$assets[] = $asset;
			}
		}
		
		$photos = array();
		$photocount = Options::get(__CLASS__ . '__randomphotosblock_count', 8);
		if(count($assets) >= $photocount) {
			while(count($photos) < $photocount) {
				// By using the output as index duplicates are impossible
				$random = $assets[array_rand($assets)];
				$photos[$random] = $random;
			}
		}
		
		$block->photos = $photos;
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
	
	/**
	 * Get a single photo for the multiple photoset view
	 **/
	public function filter_post_content_singlesetphoto($content, $post)
	{
		$assets = $post->content_media;
		if(isset($assets)) {
			// Revert what the plugin did
			$assetarray = explode("\n", $assets);
			return $assetarray[array_rand($assetarray)];
		}
		return '';
	}
	
	/**
	 * Add photosets to the output (0.10 method). The 'flow' preset is what all frontend output presets are based on.
	 * @todo: Load preset types from options
	 */
	public function filter_posts_get_update_preset($preset_parameters, $presetname, $paramarray)
	{
		if($presetname == 'flow') {
			$content_type = isset($preset_parameters['content_type']) ? Utils::single_array($preset_parameters['content_type']) : array();
			$content_type[] = 'photoset';
			$preset_parameters['content_type'] = $content_type;
		}
	}
}
?>