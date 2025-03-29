<?php

if(!function_exists("monexoApiResponse")) {

	function monexoApiResponse(int $status, string $message, array|string $data, $error = null) 
	{
		if($error == null) {
			return response()->json(['status' => $status, 'message' => $message, 'data' => $data], $status);
		}

		return response()->json(['status' => $status, 'message' => $message, 'error' => $error], $status);
	}
}