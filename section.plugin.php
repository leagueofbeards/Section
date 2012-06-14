<?php
class Section extends Plugin
{
	public function filter_default_rewrite_rules( $rules ) {
		$rules[] = array(
				'name' => 'display_multiple', 
				'parse_regex' => '%^blog(/page/(?P<page>\d+))?/?$%i',
				'build_str' => 'blog(/page/{$page})', 
				'handler' => 'UserThemeHandler', 
				'action' => 'display_blog_entries', 
				'priority' => 5, 
				'description' => 'Return blog type entries.', 
		);

		$rules[] = array(
			'name'			=>	'display_single',
			'parse_regex'	=> '%^blog/(?P<slug>[^/]*)?/?$%i',
			'build_str'		=> 'blog/{$slug}',
			'handler'		=>	'UserThemeHandler',
			'action'		=>	'display_single_blog',
			'priority'		=>	2,
			'description'	=>	'Display a given blog entry',
		);
		return $rules;
	}
	
	public function filter_theme_act_display_multiple( $handled, $theme ) {
		$paramarray = array();
		$paramarray['fallback'] = array(
			'blog.multiple'
		);

		$default_filters = array(
 			'content_type' => Post::type( 'entry' ),
		);

		$paramarray[ 'user_filters' ] = $default_filters;
		
		$theme->act_display( $paramarray );
	}

	public function filter_theme_act_display_single( $handled, $theme ) {
		$paramarray = array();
		$paramarray['fallback'] = array(
			'blog.single'
		);

		$paramarray[ 'user_filters' ] = $default_filters;
		$theme->act_display( $paramarray );
	}
}
?>