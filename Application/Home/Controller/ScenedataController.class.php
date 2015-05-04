<?php
namespace Home\Controller;
use Think\Controller;
class ScenedataController extends Controller{

    public function _initialize(){
        header('Content-type: application/json;charset=UTF-8');
	}

    public function getdata(){
		$_scenedata = M('scenedata');
		$_scenedatadetail = M('scenedatadetail');
		$where['sceneid_bigint']  = I('get.id',0);
		$where['userid_int']  = intval(session('userid'));
		$_scene_list=$_scenedata->where($where)->order('dataid_bigint asc')->select();


		$pageshowsize = I('get.pageSize',10);
		if($pageshowsize>10){
			$pageshowsize = 10;
		}

		$wheredetail['sceneid_bigint']  = I('get.id',0);
		$_scenedatadetail_list=$_scenedatadetail->where($wheredetail)->order('detailid_bigint desc')->page(I('get.pageNo',1),$pageshowsize)->select();
		$_scenedatadetail_count=$_scenedatadetail->where($wheredetail)->count();
		if(count($_scene_list)>0)
		{
			$jsonstr = '{"success":true,"code":200,"msg":"success","obj":null,"map":{"count":'.$_scenedatadetail_count.',"pageNo":'.I('get.pageNo',0).',"pageSize": '.$pageshowsize.'},"list":[[';
			$jsonstrtemp = '';
			$listkey='';
			foreach($_scene_list as $vo){
				$jsonstrtemp = $jsonstrtemp .''.json_encode($vo["elementtitle_varchar"]).',';
				$listkey=$listkey .$vo["elementid_int"].',';
			}
			$listkey = explode(',',rtrim($listkey,','));
			$jsonstr = $jsonstr.$jsonstrtemp.'"时间"],';
			$jsonstrtemp = '';			
			foreach($_scenedatadetail_list as $vo2){
				$tempjson = json_decode($vo2["content_varchar"],true);
				$jsonstrtemp = $jsonstrtemp.'[';			
				foreach($listkey as $vo3){
					$jsonstrtemp = $jsonstrtemp .json_encode($tempjson['eq']['f_'.$vo3]).',';
				}
				$jsonstrtemp = $jsonstrtemp.'"'.$vo2['createtime_time'].'"],';			
			}
			if($jsonstrtemp == '')
			{
				$jsonstrtemp = '[]';
			}
			$jsonstr = $jsonstr.rtrim($jsonstrtemp,',').']}';
		}
		else
		{
			$jsonstr='{"success":true,"code":200,"msg":"操作成功","obj":null,"map":{"count":0,"pageNo":1,"pageSize":10},"list":[]}';
		}
		echo $jsonstr;

    }

    public function add(){
		$m_scenedata=M('scenedatadetail');
		$datainput['sceneid_bigint'] = I("get.id",0);
		$datainput['ip_varchar'] = get_client_ip();
		$datainput['createtime_time'] = date('y-m-d H:i:s',time());
		
		//echo json_encode($_POST);exit;
		$datainput['content_varchar'] = json_encode($_POST);
		$result = $m_scenedata->data($datainput)->add();
		if($result)
		{
			$m_scene=M('Scene');
			$where['sceneid_bigint'] = I('get.id',0);
			$m_scene->where($where)->setInc('datacount_int');
		}
		
		$jsonstr='{"success":true,"code":200,"msg":"操作成功","obj":null,"map":{"count":0,"pageNo":1,"pageSize":10},"list":[]}';
		echo $jsonstr;
    }

    public function getcount(){
		$_scene = M('scene');
		$where['userid_int']  = intval(session('userid'));
		$where['delete_int']  = 0;
		$_scene_list=$_scene->where($where)->sum('datacount_int');
		echo '{"success":true,"code":200,"msg":"success","obj":'.$_scene_list.',"map":null,"list":null}';
    }

}