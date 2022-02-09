$ch = curl_init($this->serverIP."/organisationUnits/".$districtId.".json?fields=children[id,name,level,children[id,name,level,children[id,name,level]]]"); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch, CURLOPT_USERPWD, $this->auth);			
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);     
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);   //get status code
$result=curl_exec ($ch);
curl_close ($ch);

$data = json_decode($result, true);
$tableData[] = array();
foreach ($data['children'] as $key => $value) {

	$upazilaId = $value['id'];
	$districtLevel = $value['level'];

	if ($value['level'] == 4 && !empty($value['children'])) {

foreach ($value['children'] as $key => $levelFivevalue) {
			// $upazilaId = $value['children'][$key]['id'];
			
			$unionId = $levelFivevalue['id'];

			if (!empty($levelFivevalue['children'])) {

				foreach ($levelFivevalue['children'] as $key => $level6) {
					
					$ccId   = $level6['id'];
					$ccName = $level6['name'];

					if (stripos($level6['name'], "USC") !== false) {
					  $levelType = 'USC';

					} else if($districtLevel == 3){
						$levelType = 'CSO';
					} else {
						$levelType = 'CC';
					}

                    $check = '
Check

';
					$tableData[] = array( $check, $districtId, $upazilaId, $unionId, $levelType , $ccId, $ccName, 1);
				}

			}	

		}
	} 			
}
echo json_encode($tableData);