<?php

class ApiHandler extends RestHandler
{

	public function act_post()
	{
		$id = Controller::get_var( 'id' );

		$post = Post::get( array( 'id' => $id ) );
		$data = HabariApi::convert( $post );

		$response = new ApiResponse( 'get_post', $data );

		$response->out();
	}

}
?>