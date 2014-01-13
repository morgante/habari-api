<?php

class ApiHandler extends RestHandler
{

	public function act_post()
	{
		$id = Controller::get_var( 'id' );

		$post = Post::get( array( 'id' => $id ) );
		$data = $this->_convert_post( $post );

		$response = new ApiResponse( 'get_post', $data );

		$response->out();
	}

	private function _convert_post( Post $post ) {
		$data = $post->to_array();

		$info = $post->info->getArrayCopy();
		$data['info'] = $info;

		return $data;
	}

}
?>