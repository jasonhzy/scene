<?php
namespace Home\Controller;
use Think\Controller;
class StaticsController extends Controller {

    public function typelist(){
		header('Content-type: text/json');
		header('HTTP/1.1 200 ok');
		echo '{"success":true,"code":200,"msg":"操作成功","obj":null,"map":null,"list":[{"id":16633,"name":"行业","value":"101","type":"scene_type","sort":1,"status":1,"remark":null},{"id":16634,"name":"企业","value":"103","type":"scene_type","sort":2,"status":1,"remark":null},{"id":16635,"name":"个人","value":"102","type":"scene_type","sort":3,"status":1,"remark":null},{"id":16636,"name":"节假","value":"104","type":"scene_type","sort":4,"status":1,"remark":null},{"id":16637,"name":"风格","value":"105","type":"scene_type","sort":5,"status":1,"remark":null}]}';
	}

    public function all(){
		header('Content-type: text/json');
		header('HTTP/1.1 200 ok');
		echo '{"success":true,"code":200,"msg":"操作成功","obj":null,"map":[{"id":16633,"name":"行业","value":"101","type":"scene_type","sort":1,"status":1,"remark":null}],"list":null}';
	}
}