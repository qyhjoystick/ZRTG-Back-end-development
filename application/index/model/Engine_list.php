<?php
namespace app\index\model;

use think\Model;

class Engine_list extends Model
{
	public function get_final($data)
	{

		$json_data = array();
		// print_r($data);die();
		//有错的数组$warray，存放错误No.
		$wrong = json_decode($data["wrong"],true);
		// print_r($wrong);die();
		$warray = array();
		if ($wrong != null) {
			foreach ($wrong as $key => $value) {
				array_push($warray, $value["number"]);
			}
		}
		// print_r($warray);die();
		//设备所有信息
		$all_data = self::all();
		// print_r($all_data[0]);die();
		//传给前端的数据
		$final_data = array();
		foreach ($all_data as $key => $value) {
			for ($i=0; $i < count($warray); $i++) { 
				if ($value["no"] == $warray[$i]) {
					// print_r($value);die();
					$arr = array(
							"no"			=>		$value["no"],
							"equipment"		=>		$value["equipment"],
							"status"		=>		'异常',
							"place"			=>		$value["place"]
					);
					// print_r($arr);die();
					array_push($final_data, $arr);
					break;
					// print_r($final_data);die();
				}
				
				if ($i == count($warray)-1) {
					$arr = array(
						"no"			=>		$value["no"],
						"equipment"		=>		$value["equipment"],
						"status"		=>		'正常',
						"place"			=>		$value["place"],
				);
					array_push($final_data, $arr);	
				}
					
					
					// print_r($final_data);die();
				
				
			}
			
			// print_r($final_data);die();
		}
		// print_r($final_data);die();

		return $final_data;
	}

}



?>