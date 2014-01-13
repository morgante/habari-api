<?php

class ApiResponse extends RestResponse
{
	/**
	 * Create a new ApiResponse
	 * @param string $endpoint The endpoint that generated this data
	 * @param array $data     An array of data to return
	 */
	public function __construct( $endpoint, $data )
	{
		$this->response = array(
			'endpoint' => $endpoint,
			'data' => $data
		);
	}

	/**
	 * Convert our response to JSON
	 * @param  array $data The response data
	 * @return string The JSON-encoded response data
	 */
	public function convert_applicaton_json( $data )
	{
		return json_encode( $data );
	}

	/**
	 * Override get_best_mime to serve json for HTML endpoints
	 * @param  array $mime_types
	 * @return string             The best mime type
	 */
	public function get_best_mime( $mime_types = null ) {
		$mime = parent::get_best_mime( $mime_types );

		if ( $mime == 'text/html' ) {
			$mime = 'application/json';
		}

		return $mime;
	}

}
?>