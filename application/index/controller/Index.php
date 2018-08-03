<?php
namespace app\index\controller;
use think\Controller;
use think\Config;
use think\Db;
use app\index\model\User;
use app\index\model\Engine;
use app\index\model\Engine_list;
use think\Request;

class Index extends Controller
{
    public function _initialize()
    {
        header('Content-Type: application/json; charset=utf-8');
        header("Access-Control-Allow-Headers: Origin, X-Requested-With,Json, Content-Type, Accept, Authorization");
        header("Access-Control-Allow-Methods: POST,GET,OPTIONS");
        header("Access-Control-Expose-Headers: *");
        header("Access-Control-Allow-Credentials: true");
    }

	public function equipment()
	{
        $data = Db::table('equipment')->select();
        
		return json_encode($data);
	}

    public function login()
    {
        if($this->request->isPost()){       
            $postdata=$this->request->post();
            // dump($postdata["account"]);die();
            $model=new User();
            if(empty($postdata["account"]) || empty($postdata["password"])){
                $reply_data=[
                    "code"=>2,
                    "msg"=>"账号和密码都不能为空"
                ];
                return json($reply_data);
            }

            $res = $model->get_user_info($postdata["account"],$postdata["password"]);

            if ($res == null) {
                $reply_data=[
                    "code"=>2,
                    "msg"=>"账户与密码不匹配"
                ];
                return json($reply_data);
            }else{
                // echo 2333;die();
                $reply_data=[
                        "code"=>1,
                        "msg"=>"登入成功",
                        "name"=>$postdata["account"]
                        // "date"=>$info
                ];
                // echo gettype(json($reply_data));
                // die();
                return json($reply_data);
            }
        }
    }

    public function engine2()
    {
        if($this->request->isPost()){       
            $model = new Engine();
            $model2 = new engine_list();
            $postdata = $this->request->post();
            //首次进入此界面
            if ($postdata["code"] == 0) {
                $data = $model->get_today();
                // print_r($data);die();
            }else{
                // print_r($postdata["date"]);die();
                //非首次进入,返回相应时间的问题
                $data = $model->get_choose($postdata["status"],$postdata["date"]); 
                // print_r($data);die();
            } 
            $final_data = $model2->get_final($data);
            // print_r($final_data);die();
            // if ($final_data == null) {
            //     $final_data = array(
            //                 "no"            =>      '',
            //                 "equipment"     =>      '',
            //                 "status"        =>      '',
            //                 "place"         =>      ''
            //             );
            // }
            // print_r($final_data);die();
            return json($final_data);
        }
        return ;
    }
    public function test()
    {
        echo 323232;
        return ;
    }

    
}
