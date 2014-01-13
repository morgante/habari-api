<?php
namespace Habari;

if ( !defined( 'HABARI_PATH' ) ) {
	die( 'No direct access' );
}

require_once( 'apihandler.php' );
require_once( 'apiresponse.php' );

class HabariApi extends Plugin
{

	/**
     * Add needed rewrite rules
     */
    public function filter_rewrite_rules( $rules )
    {
            $rules[] = new RewriteRule( array(
                    'name' => 'api_base',
                    'parse_regex' => '%api/posts/(?P<id>\d+)/?$%i',
                    'build_str' => 'api/posts/{$id}',
                    'handler' => 'ApiHandler',
                    'action' => 'post',
                    'priority' => 7,
                    'is_active' => 1,
                    'description' => 'Fetches a post by id',
            ));

            return $rules;
    }

}

?>