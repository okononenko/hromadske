<?php
	header("Content-type: application/json");
	processRequest();

	function processRequest(){
		if(!isset($_GET['id'])){echo errMsg("post id not set"); return;} 
		$id = intval($_GET['id']);
		if(!$id) {echo errMsg("post id format error"); return;} 
		$result = toolsApiRequest("news.post.commentscount.update", array("id" => $id));
		if(!$result) {echo errMsg("calling comments count update api error"); return;}
		echo resMsg('{"count": '.$result -> count.'}');
	}

	function resMsg($data){
		return '{"result": '.$data.'}';
	}

	function errMsg($err){
		return '{"error":"'.$err.'"}';
	}

	function toolsApiRequest($method, $params = null){
		$url = "http://tools.kgtv.com.ua/api/v1/".$method;
		if($params){
			$i = 0;
			foreach ($params as $key => $value) {
				if($i == 0) $url .= "?".$key."=".$value;
				else $url .= "&".$key."=".$value;
				$i++;
			}
		}
		$data = getJSON($url);
		if(!$data) return null;
		if(isset($data -> error)) return null;
		if(!isset($data -> result)) return null;
		return $data -> result;
	}

	function getJSON($url){
		$str = file_get_contents($url);
		return json_decode($str);
	}
?>