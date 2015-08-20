<?php
namespace Home\Controller;
use Think\Controller;
header("Content-type: text/html; charset=utf-8");
class CommonController extends Controller{
	public function _initialize(){
		$id = session('id');
		if ($id == null) {
			$this->error("请先登录");
		}
	}
}