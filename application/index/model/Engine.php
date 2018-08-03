<?php
namespace app\index\model;

use think\Model;

class Engine extends Model
{
	public function get_choose($status,$date)
	{
		// $map['status']    =	$status;
        $map['time']  	= 	array('like','%'.$date.'%');
        $data = self::where($map)->find();

        // if($status == ''){
        // 	$data = self::where($map)->find();
        // 	// print_r($data);die();
        // }elseif ($map['date'] == '') {
        // 	$data = self::get(['status'=>$status]);
        // }else{
        // 	$data = self::get($map);
        // }
       	// if ($data != null) {
       	// 	$data = $data->toArray();
       	// }
        
        return $data;

	}
	public function get_today()
	{
		$today = date("Y-m-d");
		$map['time']  = array('like','%'.$today.'%');
		$data = self::get($map);
		if ($data != null) {
			$data = $data->toArray();
		}
		return $data;

	}
}



?>