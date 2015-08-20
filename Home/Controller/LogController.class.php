<?php
namespace Home\Controller;
use Home\Controller\CommonController;
header("Content-type: text/html; charset=utf-8");
class LogController extends CommonController {
    
    public function index() {
         $this->display('Log:new_log');
    }

    
    public function show_newLog(){

    	$caseid=$_GET['caseid'];
    	if ($caseid) {
    		$_SESSION['caseid']=$caseid;
    	}
    	
    	$Diary=M('Diary');
    	$condition['caseid']=$_SESSION['caseid'];
    	$rs=$Diary->where($condition)->select();
    	$this->assign("list",$rs);
    	$this->display('Log:new_log');

    }

    public function addLog(){
    	$caseid=$_SESSION['caseid'];
    	$title=$_POST['title'];
    	$userid=$_SESSION['id'];
    	$body=$_POST['body'];
    	$labels=$_POST['label'];

    	$Diary=M('Diary');
    	$Diarylabel=M('Diarylabel');

    	$Diary->caseid=$caseid;
    	$Diary->userid=$userid;
    	$Diary->title=$title;
    	$Diary->body=$body;
    	if($lastInsId = $Diary->add()){
    		 $label = explode(',', $labels);  // 按逗号分隔拆分标签
            for($index = 0; $index < count($label); $index++) { 
                $Diarylabel->diaryId = $lastInsId;
                $Diarylabel->value = $label[$index];
                $Diarylabel->add();
    		}
    	}
  		$this->show_newLog();
        
    }

    public function show_log(){
    	$diaryId=$_GET['diaryId'];

    	$Diary=M('Diary');
    	$condition['caseid']=$_SESSION['caseid'];
    	$rs=$Diary->where($condition)->select();

    	$condition1['id']=$diaryId;
    	$diary=$Diary->where($condition1)->find();


    	$condition2['id']=$diary['userid'];
    	$User=M('User');
    	$user=$User->where($condition2)->find();
    	$nickName=$user['nickname'];
    	$condition3['diaryid']=$diaryId;
    	$Diarylabel=M('Diarylabel');
    	
    	$label=$Diarylabel->where($condition3)->select();
    	$this->assign("diary",$diary);
    	$this->assign("list",$rs);
    	$this->assign('nickname',$nickName);
    	$this->assign('label',$label);
    	$this->display('Log:show_log');
    }

    public function show_modify_log(){

		$diaryId=$_GET['diaryId'];

    	$Diary=M('Diary');
        $label=M("Diarylabel");
        $condition1['diaryid']=$diaryId;
        $list=$label->where($condition1)->select();
         foreach ($list as $key => $value) {
            $labels=$labels.$value['value'].',';
        }
        $labels = substr($labels,0,strlen($labels)-1); 
        $labels=$labels." ";
    	$condition['caseid']=$_SESSION['caseid'];
    	$rs=$Diary->where($condition)->select();

    	$condition1['id']=$diaryId;
    	$diary=$Diary->where($condition1)->find();
    	
    	$this->assign("labels", $labels);

    	$this->assign("diary",$diary);
    	$this->assign("list",$rs);
    	$this->display('Log:modify_log');
    }

    public function modify_log(){
    	$diaryId=$_GET['diaryId'];
    	$title=$_POST['title'];
    	//$userid=$_SESSION['userid'];
    	//$body=$_POST['body'];
    	$userid=2;
    	$body=$_POST['body'];
    	$labels=$_POST['label'];
    	$Diary=M('Diary');
    	$condition['id']=$diaryId;
    	$diary=$Diary->where($condition)->find();
    	$diary['title']=$title;
    	$diary['body']=$body;
    	$condition2['diaryId']=$diaryId;
    	
    	$Diarylabel=M('Diarylabel');
        $Diarylabel->where($condition2)->delete();
    	if($Diary->save($diary)){
    		$Diarylabel->where($condition2)->delete();
    		$label = explode(',', $labels);  // 按逗号分隔拆分标签
            for($index = 0; $index < count($label); $index++) { 
                $Diarylabel->diaryId = $diaryId;
                $Diarylabel->value = $label[$index];
                $Diarylabel->add();
    		}		
    	}
    	$this->show_newLog();

    }

    public function delete_log(){
    	$diaryId=$_GET['diaryId'];
    	$userid=$_SESSION['userid'];
    	$Diary=M('Diary');
    	$condition['id']=$diaryId;
    	$diary=$Diary->where($condition)->find();
    	$Diarylabel=M('Diarylabel');
    	$condition2['diaryId']=$diaryId;
    	if($diary['userid']!=$userid){
    		$this->error("非发起者不可删除");
    	}else{
    		if (($Diary->where($condition)->delete())&&($Diarylabel->where($condition2)->delete())) {
    		$this->success("删除成功");	
    		}
    		$this->error("删除失败");
    	}

    	
    }
    	

}