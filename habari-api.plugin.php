<?php

if ( !defined( 'HABARI_PATH' ) ) {
	die( 'No direct access' );
}

require('apihandler.php');

class HabariApi extends Plugin
{
 		/**
         * Add needed rewrite rules
         */
        public function filter_rewrite_rules( $rules )
        {
                $rules[] = new RewriteRule( array(
                        'name' => 'link_feed',
                        'parse_regex' => '%api/?$%i',
                        'build_str' => 'api',
                        'handler' => 'ApiHandler',
                        'action' => 'base',
                        'priority' => 7,
                        'is_active' => 1,
                        'description' => 'Displays the API base',
                ));

                // // '"link"/"redirect"/slug', 'link_redirect');                
                
                // $rules[] = new RewriteRule( array(
                //         'name' => 'link_redirect',
                //         'parse_regex' => '%link/redirect/(?P<slug>[^/]+)/?$%i',
                //         'build_str' => 'link/redirect/{$slug}',
                //         'handler' => 'PluginHandler',
                //         'action' => 'link_redirect',
                //         'priority' => 7,
                //         'is_active' => 1,
                //         'description' => 'Redirects to the linked item',
                // ) );

                return $rules;
        }
}

?>