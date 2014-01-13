<?php

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

    /**
     * Register our hooks
     */
    public function alias()
    {
        return array(
            'post_save' => array('action_post_update_after')
        );
    }

    public function post_save( $post )
    {
        $data = self::encode( $post );

        Plugins::act( 'queue_send', 'post', $data );
    }

    public static function encode( $data )
    {
        switch (get_class( $data ) )
        {
            case 'Habari\Post':
                $data = self::convert_post( $data );
                break;
        }

        return json_encode( $data );
    }

    private static function convert_post( Post $post ) {
        $data = $post->to_array();

        $info = $post->info->getArrayCopy();
        $data['info'] = $info;

        return $data;
    }

}

?>