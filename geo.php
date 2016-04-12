<?php
	include("geoipcity.inc");
	include("geoipregionvars.php");
	
	function getRandIp()
	{
		$ip = rand(0, 255) . "." . rand(0, 255) . "." . rand(0, 255) . "." . rand(0, 255);
		return $ip;
	}
	
	function getLocation($gi, $ip)
	{			
		$record = geoip_record_by_addr($gi, $ip);		
		$location = "";
		if ($record->country_name != "")
			$location = $record->country_name . " (" . $record->city . ")";		
		return $location;		
	}
	
	function start($nbr)
	{
		$gi = geoip_open(realpath("GeoLiteCity.dat"), GEOIP_STANDARD);
		for ($i = 0; $i < $nbr; $i++){
			$ip = getRandIp();
			$location = getLocation($gi, $ip);
			echo $ip . " : " . $location . "</br>";
		}
		geoip_close($gi);		
	}
?>	
	
	<form method="post" action="geo.php">
		Nombre de IPs aleatoires <input type="text" name="nbr" />
		<input type="submit" value="Geolocaliser" />
	</form>
	
	
<?php	
	$nbr = 100;
	if ($_REQUEST["nbr"] != "")
		$nbr = $_REQUEST["nbr"];
	echo $nbr . " IPs aleatoires<br/><br/>";
	start($nbr);
?>