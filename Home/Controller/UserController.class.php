<?php
namespace Home\Controller;
use Home\Controller\CommonController;
header("Content-type: text/html; charset=utf-8");
class UserController extends CommonController {
    public function index() {
        $label=M("Label");
        $case=M("Case");
        $casejoin=M("Casejoin");
        $casefocus=M("casefocus");
        $score=M("User");
        $usercondition['id']=$_SESSION['id'];
        $find=$score->where($usercondition)->find();
        $scoredata['score']=$find['score'];
        if ($scoredata['score']<20) {
            $scoredata['level']="/mochou/Public/img/stars1.gif";
        }else if ($scoredata['score']<40) {
             $scoredata['level']="/mochou/Public/img/stars2.gif";
        }else if ($scoredata['score']<60) {
             $scoredata['level']="/mochou/Public/img/stars3.gif";
        }else if ($scoredata['score']<80) {
             $scoredata['level']="/mochou/Public/img/stars4.gif";
        }elseif ($scoredata['score']==0) {
            $scoredata['level']="/mochou/Public/img/stars0.gif";
        }else{
             $scoredata['level']="/mochou/Public/img/stars5.gif";
        }
        $evalute['isEvaluted']=0;
        $evalute['userid']=$_SESSION['id'];
        $evalute['sign']=C('JOIN_PASS');
        $joinCases=$casejoin->where($evalute)->select();
        $casestate['state']=C('CASE_OVER');
        $unFinishCases=array();
        $caseindex=0;
        foreach ($joinCases as $key => $value) {
            $caseindex++;
            $casestate['id']=$value['caseid'];
            $tempCase=$case->where($casestate)->find();
            if ($tempCase==null) {
               
            }else{
                $unFinishCases[$index]['title']=$tempCase['title'];
                 $unFinishCases[$index]['caseid']=$tempCase['id'];
                $members['caseid']=$tempCase['id'];
                $members['sign']=C('JOIN_PASS');
                $allmembers=$casejoin->where($members)->select();
                foreach ($allmembers as $key1 => $value1) {
                   $memberuser['id']=$value1['userid'];
                   $tempUser=$score->where($memberuser)->find();
                   $unFinishCases[$index][]=$tempUser['nickname'];
                }
            }
        }
        $condition['userid']=$_SESSION['id'];
        $condition1['userid']=$_SESSION['id'];
        $condition1['sign']=C('JOIN_PASS');
        $condition2['userid']=$_SESSION['id'];
        $condition2['sign']=C('FOCUSED');
        $listcreate=$case->where($condition)->select();
        $join=$casejoin->where($condition1)->select();
        $focus=$casefocus->where($condition2)->select();
        $list=$label->where($condition)->select();
        $listjoin=array();
        $listfocus=array();
        
        foreach ($list as $key => $value) {
            $labels=$labels.$value['content'].',';
        }
        $labels = substr($labels,0,strlen($labels)-1); 
        $labels=$labels." ";
        foreach ($join as $key => $value) {
           $listjoin[$i]=$case->where("id='%s'",$value['caseid'])->find();
        }
        foreach ($focus as $key => $value) {
           $listfocus[]=$case->where("id='%s'",$value['caseid'])->find();
        }

        $this->assign("unFinishCases",$unFinishCases);
        $this->assign("scoredata",$scoredata);
        $this->assign("list", $labels);
        $this->assign("listcreate",$listcreate);
        $this->assign("listjoin",$listjoin);
        $this->assign("listfocus",$listfocus);


         if (!($_SESSION['username'] == C('admin'))){
             $this->display("User:index");
        }else{
            $allCase=$case->select();
            $index=0;
            $rs=array();
            $user=M("User");
            foreach ($allCase as $key => $value) {
               $rs[$index]['id']=$index+1;
               $rs[$index]['title']=$value['title'];
               $rs[$index]['caseid']=$value['id'];
               $data['id']=$value['userid'];
               $temp=$user->where($data)->find();
               $rs[$index]['userid']=$value['userid'];
               $rs[$index]['nickname']=$temp['nickname'];
            }
            $this->assign("cases",$rs);
            $this->display("User:check");
        }
       
    }

    public function view(){
        $label=M("Label");
        $case=M("Case");
        $casejoin=M("Casejoin");
        $casefocus=M("casefocus");
        $User=M('User');
        $usercondition['id']=$_GET['id'];
        $find=$User->where($usercondition)->find();
        $scoredata['score']=$find['score'];
        if ($scoredata['score']<20) {
            $scoredata['level']="/mochou/Public/img/stars1.gif";
        }else if ($scoredata['score']<40) {
             $scoredata['level']="/mochou/Public/img/stars2.gif";
        }else if ($scoredata['score']<60) {
             $scoredata['level']="/mochou/Public/img/stars3.gif";
        }else if ($scoredata['score']<80) {
             $scoredata['level']="/mochou/Public/img/stars4.gif";
        }elseif ($scoredata['score']==0) {
            $scoredata['level']="/mochou/Public/img/stars0.gif";
        }else{
             $scoredata['level']="/mochou/Public/img/stars5.gif";
        }

        $condition['userid']=$_GET['id'];
        $condition1['userid']=$_GET['id'];
        $condition1['sign']=C('JOIN_PASS');
        $condition2['userid']=$_GET['id'];
        $condition2['sign']=C('FOCUSED');
        $listcreate=$case->where($condition)->select();
        $join=$casejoin->where($condition1)->select();
        $focus=$casefocus->where($condition2)->select();
        $list=$label->where($condition)->select();
        $condition3['id']= $condition['userid'];
        $user=$User->where($condition3)->find();
        $listjoin=array();
        $listfocus=array();
        foreach ($join as $key => $value) {
           $listjoin[]=$case->where($value['caseid'])->find();
        }
        foreach ($focus as $key => $value) {
           $listfocus[]=$case->where($value['caseid'])->find();
        }
         $this->assign("scoredata",$scoredata);
        $this->assign("nickname",$user['nickname']);
        $this->assign("head",$user['head']);
        $this->assign("email",$user['email']);
         $this->assign("list", $list);
         $this->assign("listcreate",$listcreate);
         $this->assign("listjoin",$listjoin);
         $this->assign("listfocus",$listfocus);
        $this->display('User:view');
    }

    //评价
    public function evalute(){
       
        $join['caseid']=$_GET['caseid'];
        $join['userid']=$_SESSION['id'];
        $data['isEvaluted']=1;
        $casejoin=M("Casejoin");
        $casejoin->where($join)->save($data);
        $this->Index();
        
    }
   
    //更新昵称
    public function updateNickname() {
        $data['nickname'] = $_GET['newnickname'];
        $username = session('username');
        $User = M("User");
        $User->where("email='%s'",$username)->save($data);
        session('nickname',$data['nickname']);
        $this->ajaxReturn(10);
    }

    //更新密码
    public function updatePass() {
        $oldpass = $_GET['oldpassword'];
        $data['password'] = $_GET['newpassword'];
        $username = session('username');
        //$username="12301117@bjtu.edu.cn";
        $User = M("User");
        $rs=$User->where("email='%s'",$username)->find();
        if($rs['password']!=$oldpass) {
            $this->ajaxReturn('Old Password Wrong!');
        } else {
            $User->where("email='%s'",$username)->save($data);
            $this->ajaxReturn(10);
        }
    }

    // 注销
    public function logout() {
        $_SESSION['nickname'] = "";
        $_SESSION['id'] = "";
        session_destroy();
        $Index = A('Index');
        $Index->index();
    }

    // 上传头像
    public function saveHeadPortrait() {
        if (!$_FILES['Filedata']) {
            die ( 'Image data not detected!' );
        }
        if ($_FILES['Filedata']['error'] > 0) {
            switch ($_FILES ['Filedata'] ['error']) {
            case 1 :
                $error_log = 'The file is bigger than this PHP installation allows';
                break;
            case 2 :
                $error_log = 'The file is bigger than this form allows';
                break;
            case 3 :
                $error_log = 'Only part of the file was uploaded';
                break;
            case 4 :
                $error_log = 'No file was uploaded';
                break;
            default :
                break;
            }
            die ( 'upload error:' . $error_log );
        } else {
            $img_data = $_FILES['Filedata']['tmp_name'];
            $size = getimagesize($img_data);
            $file_type = $size['mime'];
            if (!in_array($file_type, array('image/jpg', 'image/jpeg', 'image/pjpeg', 'image/png', 'image/gif'))) {
                $error_log = 'only allow jpg,png,gif';
                die ( 'upload error:' . $error_log );
            }
            switch($file_type) {
                case 'image/jpg' :
                case 'image/jpeg' :
                case 'image/pjpeg' :
                $extension = 'jpg';
                break;
                case 'image/png' :
                $extension = 'png';
                break;
                case 'image/gif' :
                $extension = 'gif';
                break;
            }   
        }   
        if (!is_file($img_data)) {
            die ( 'Image upload error!' );
        }
        //图片保存路径,默认保存在该代码所在目录(可根据实际需求修改保存路径)
        $save_path =  $_SERVER['DOCUMENT_ROOT'] . 'mochou/uploads';
        $filename = $save_path . '/' . $_SESSION['id'] . '.' . $extension;
        $result = move_uploaded_file( $img_data, $filename );
        if ( ! $result || ! is_file( $filename ) ) {
            die ( 'Image upload error!' );
        } else {
            $data['head'] = '/mochou/uploads/'. $_SESSION['id'] . '.' . $extension;
            $id = session('id');
            $User = M("User");
            $User->where("id='%s'",$id)->save($data);
            session('head',$data['head']);
        }
        echo 'Image data save successed,file:' . $filename;
        exit ();
    }

    //保存个人标签
    public function updateLabel(){
          $labels = $_POST['label'];
          $labelModel=M('label');
          $userid=$_SESSION['id'];
          $condition['userid']=$userid;
          $labelModel->where($condition)->delete();
          $label = explode(',', $labels);  // 按逗号分隔拆分标签
            for($index = 0; $index < count($label); $index++) { 
                $labelModel->userid = $userid;
                $labelModel->content = $label[$index];
                if(!( $labelModel->add())){
                    $this->error('保存失败');
                }
              
            }
            $this->success('保存成功');
    }



}