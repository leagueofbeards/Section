<?php
class Section extends Plugin
{
	const URL_SPACE = 'blog';
	
	public function filter_default_rewrite_rules( $rules ) {
		$rules[] = array(
				'name' => 'display_multiple', 
				'parse_regex' => '%^' . self::URL_SPACE . '(/page/(?P<page>\d+))?/?$%i',
				'build_str' => self::URL_SPACE . '(/page/{$page})', 
				'handler' => 'UserThemeHandler', 
				'action' => 'display_multiple', 
				'priority' => 5, 
				'description' => 'Create a section', 
		);

		$rules[] = array(
			'name'			=>	'display_single',
			'parse_regex'	=> '%^' . self::URL_SPACE . '/(?P<slug>[^/]*)?/?$%i',
			'build_str'		=> self::URL_SPACE . '/{$slug}',
			'handler'		=>	'UserThemeHandler',
			'action'		=>	'display_single',
			'priority'		=>	2,
			'description'	=>	'Display a entries from a section',
		);
		
		return $rules;
	}
	
	public function filter_theme_act_display_multiple( $handled, $theme ) {
		$paramarray = array();
		$paramarray['fallback'] = array(
			'section.multiple'
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
			'section.single'
		);

		$paramarray[ 'user_filters' ] = $default_filters;
		$theme->act_display( $paramarray );
	}
}
?>