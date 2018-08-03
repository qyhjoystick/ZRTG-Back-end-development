<?php
namespace app\index\model;

use think\Model;

class User extends Model
{
	public function get_user_info($account,$password){
		

		// $user = User::get(['account' => $account ,'password' => $password]);
		// // echo $user;die();
		// if(!$user){
		// 	$user = $user->toArray();
		// }else{
		// 	$user = null;
		// }
		$where['account']   = $account;
        $where['password']  = $password;
        // $somebody = User::where($where)->find();
        // return !empty($somebody)?$somebody->toArray():null;
        $somebody = self::get($where);
        if ($somebody) {
        	$somebody = $somebody->toArray();
        }
        return $somebody;

		
		
	}
}



?>