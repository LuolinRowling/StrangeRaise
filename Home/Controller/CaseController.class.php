<?php
namespace Home\Controller;
use Home\Controller\CommonController;
header("Content-type: text/html; charset=utf-8");
class CaseController extends CommonController {
    public function index() {
        $this->display();
    }
    /**
    *   新建Case
    */
    public function initiate() {
        // 从前端获取值
        $title = $_POST['title'];
        $content = $_POST['content'];
        $htmlcontent = $_POST['htmlcontent'];
        $feedback = $_POST['feedback'];
        $labels = $_POST['label'];
        $staffs = $_POST['staff'];
        $contact_qq = $_POST['qq'];
        $contact_wechat = $_POST['wechat'];
        $contact_phone = $_POST['phone'];
        $contact_email = $_POST['email'];
        $tmpcontact = array($contact_qq,$contact_wechat,$contact_phone,$contact_email);
        $contact = implode(",",$tmpcontact);

        // 实例化模型类
        $Case = M("Case");
        $Caselabel = M("Caselabel");
        $Casestaff = M("Casestaff");

        // 数据对象赋值
        $Case->userid = $_SESSION['id'];
        $Case->title = $title;
        $Case->content = $content;
        $Case->htmlcontent = $htmlcontent;
        $Case->feedback = $feedback;
        $Case->contact = $contact;
        $Case->publishtime = date("Y-m-d H:i:s");
        $Case->state = C('CASE_PREPARE');
        // 插入数据库
        if($lastInsId = $Case->add()) {
            // 将标签插入数据库
            $label = explode(',', $labels);  // 按逗号分隔拆分标签
            for($index = 0; $index < count($label); $index++) { 
                $Caselabel->caseid = $lastInsId;
                $Caselabel->content = $label[$index];
                $Caselabel->add();
            }
            
            // 将需求的人才插入数据库
            $staff = explode(',',$staffs);
            for($index = 0; $index < count($staff); $index=$index+2) {
                $Casestaff->caseid = $lastInsId;
                $Casestaff->job = $staff[$index];
                $Casestaff->number = $staff[$index+1];
                $Casestaff->add();
            }

            // 给发布这个项目的用户推荐一些适合参与此项目的用户
            

            $Index = A('Index');
            $Index->index();
        } else {
            $this->error("发布失败");
        }
    }
     /**
    *   查看Case
    */
    public function view() {
        $caseid = $_GET['caseid'];
        if (!$caseid) {
             $caseid=$_SESSION['caseid'];
        }else{
            $_SESSION['caseid']=$caseid;
        }
        $Case = M("Case");
        $User = M("User");
        $Caselabel = M("Caselabel");
        $Caseadd = M("Caseadd");
        $Casestaff = M("Casestaff");
        $Casefocus = M("Casefocus");
        $Casejoin = M("Casejoin");
        $Casereply = M("Casereply");

        // 查找id值为$caseid的Case数据
        $condition1['id'] = $caseid;
        $data1 = $Case->where($condition1)->find();
        // 点击数加1
        $data1['clicks']++;
        $Case->where($condition1)->save($data1);

        $condition2['id'] = $data1['userid'];
        $nickname = $User->where($condition2)->getField('nickname');
        $head = $User->where($condition2)->getField('head');

        $condition3['caseid'] = $caseid;
        $data2 = $Caselabel->where($condition3)->getField('content',true);

        $condition4['caseid'] = $caseid;
        $data3 = $Casestaff->where($condition4)->select();

        $data4 = explode(',', $data1['contact']);

        $condition5['caseid'] = $caseid;
        $data5 = $Caseadd->where($condition5)->getField('content',true);


        $condition6['caseid'] = $caseid;
        $condition6['userid'] = $_SESSION['id'];
        $data6 = $Casefocus->where($condition6)->getField('sign');
        if($data6==null) {
            $data6 = 3000;
        }

        $condition7['caseid'] = $caseid;
        $condition7['userid'] = $_SESSION['id'];
        $data7 = $Casejoin->where($condition6)->getField('sign');
        if($data7==null) {
            $data7 = 4444;
        }

        $condition8['caseid'] = $caseid;
        $data8 = $Casereply->where($condition8)->select();
        $index=0;
        foreach ($data8 as $key => $value) {
            $condition888['id']=$value['userid'];
            $temp=$User->where($condition888)->find();
            $tmpnickname=$temp['nickname'];
            $data8[$index]['nickname']=$tmpnickname;
            $index=$index+1;
        }

        $Diary=M('Diary');
        $condition9['caseid']=$caseid;
        $data9=$Diary->where($condition9)->select();
    

        $this->assign("list", $data1);
        $this->assign("nickname", $nickname);
        $this->assign("head", $head);
        $this->assign("label", $data2);
        $this->assign("staff", $data3);
        $this->assign("contact", $data4);
        $this->assign("supplement", $data5);
        $this->assign("focusstate", $data6);
        $this->assign("joinstate", $data7);
        $this->assign("replys", $data8);
        $this->assign("diary",$data9);
        $this->display('Case:view');
    }
    /**
    *   补充说明
    */
    public function supplement() {
        // 从前端获取值
        $tmpcontent = $_GET['addcontent'];
        $caseid = $_GET['caseid'];

        // 实例化模型类
        $Caseadd = M("Caseadd");

        // 数据对象赋值
        $Caseadd->caseid = $caseid;
        $Caseadd->content = $tmpcontent;
        $Caseadd->time = date("Y-m-d H:i:s");
        if($lastInsId = $Caseadd->add()) {
            $this->ajaxReturn(10);
        } else {
            $this->ajaxReturn("添加补充内容失败");
        }
    }
    /**
    *   更改状态
    */
    public function changestate() {
        $caseid = $_GET['caseid'];
        $Case = M("Case");
        $condition1['id'] = $caseid;
        $data1 = $Case->where($condition1)->find();
        $change['state']=$data1['state']+1;
        $Case->where($condition1)->save($change);
        $this->ajaxReturn(10);
    }
   /**
    *  加入
    */
    public function join() {
        $caseid = $_GET['caseid'];
        $userid = $_SESSION['id'];
        $content = $_GET['content'];
        $contact = $_GET['contact'];

        $Casejoin = M("Casejoin");

        $condition['caseid'] = $caseid;
        $condition['userid'] = $userid;
        if($Casejoin->where($condition)->select() != NULL) {
            $this->ajaxReturn("Has Submit Join");
        }

        $Casejoin->caseid = $caseid;
        $Casejoin->userid = $userid;
        $Casejoin->content = $content;
        $Casejoin->contact = $contact;
        $Casejoin->time = date("Y-m-d");
        $Casejoin->sign = C('JOIN_UNAUDIT');

        if($lastInsId = $Casejoin->add()) {
            $this->ajaxReturn(10);
        } else {
            $this->ajaxReturn("Join Fail");
        }
    }
   /**
    *  关注
    */
    public function focus() {
        $caseid = $_GET['caseid'];
        $userid = $_SESSION['id'];

        $Casefocus = M("Casefocus");
        $condition['caseid'] = $caseid;
        $condition['userid'] = $userid;
        $temp = $Casefocus->where($condition)->find();
        if($temp != NULL) {
            if($temp['sign'] == C('FOCUSED')) {
                $change['sign'] = C('UNFOCUSED');
            } else {
                $change['sign'] = C('FOCUSED');
            }
            $Casefocus->where($condition)->save($change);
            $this->ajaxReturn(1);
        } else {
            $Casefocus->caseid = $caseid;
            $Casefocus->userid = $userid;
            $Casefocus->sign = C('FOCUSED');
            if($lastInsId = $Casefocus->add()) {
                $this->ajaxReturn(1);
            } else {
                $this->ajaxReturn("fail");
            }
        }
    }
    /**
    *  查看响应人
    */
    public function show_members() {
        $caseid = $_GET['caseid'];
        $condition1['caseid']=$caseid;
        $condition1['sign']=C('JOIN_UNAUDIT');
        $condition2['caseid']=$caseid;
        $condition2['sign']=C('JOIN_PASS');
        $Casejoin=M("Casejoin");
        $rs1=$Casejoin->where($condition1)->select(); 
        $rs2=$Casejoin->where($condition2)->select();
        $User=M("User");
        $index1=0;
        foreach ($rs1 as $key => $value) {
            $condition3['id']=$value['userid'];
            $temp=$User->where($condition3)->find();
            $nickname=$temp['nickname'];
            $email=$temp['email'];
            $rs1[$index1]['nickname']=$nickname;
            $rs1[$index1]['email']=$email;
            $rs1[$index1]['head']=$temp['head'];
            $index1=$index1+1;
        }
        $index2=0;
        foreach ($rs2 as $key => $value) {
            $condition4['id']=$value['userid'];
            $temp=$User->where($condition4)->find();
            $nickname=$temp['nickname'];
            $email=$temp['email'];
            $rs2[$index2]['nickname']=$nickname;
            $rs2[$index2]['email']=$email;
            $rs2[$index2]['head']=$temp['head'];
            $index2=$index2+1;
        }
        $this->assign("list1",$rs1);
        $this->assign("list2",$rs2);
        $this->display('show_response');
    }
    /**
    *   谢绝加入申请
    */
    public function refuse(){
        $userid=$_POST['email'];
        $content=$_POST['content'];
        $emailto = $userid; //接收邮件方，本例为注册用户的Email 
        $emailsubject = "陌筹来信";//邮件标题 
        //邮件主体内容 
        $emailbody = "亲爱的陌筹用户：<br/>感谢您的参与<br/>
            ".$content."<br/>";
        if(SendMail($emailto,$emailsubject,$emailbody)) {
            $data['sign']=C('JOIN_REFUSE');
            $join=M("Casejoin");
            $join->where($condition)->save($data);
            $this->show_members();
        } else {
            $this->error("回绝失败");
        }

    }
    /**
    *   同意加入申请
    */
    public function agree(){
        $condition['id']=$_GET["id"];
        $data['sign']=C('JOIN_PASS');
        $join=M("Casejoin");
        $join->where($condition)->save($data);
        $this->show_members();
    }
    /**
    *   评论
    */
    public function reply(){
        $caseid = $_GET['caseid'];
        $reply = $_GET['reply'];

        $Casereply = M('Casereply');

        $Casereply->caseid = $caseid;
        $Casereply->userid = $_SESSION['id'];
        $Casereply->content = $reply;
        $Casereply->time = date("Y-m-d H:i:s");
        $Casereply->add();
        
        $this->ajaxReturn(10);
    }
    /**
    *   检索
    */
    public function search() {
        $searchword = $_POST['searchword'];

        $User = M("User");
        $Case = M("Case");
        $Caselabel = M("Caselabel");

        $condition['content'] = array('like', "%".$searchword."%");

        $searchcaseid = $Caselabel->distinct(true)->where($condition)->getField('caseid',true);

        $i = 0;
        foreach ($searchcaseid as $key => $value) {
            $list[$i]=$Case->where("id='%s'",$value)->find();
            if(strlen($list[$i]['content'])>200) {
                $list[$i]['content'] =  mb_substr($list[$i]['content'], 0, 100,'utf-8');
                $arr = array($list[$i]['content'],'···');
                $list[$i]['content'] = implode($arr);
            }

            $rs=$User->where("id='%s'",$list[$i]['userid'])->find();
            $list[$i]['nickname'] = $rs['nickname'];
            $list[$i]['head'] = $rs['head'];

            $condition1['caseid'] = $value;
            $labeldata = $Caselabel->where($condition1)->select();
            foreach ($labeldata as $key => $value2) {
                $list[$i][]=$value2['content'];
            }
            $i = $i + 1;
        }
        // 模板变量赋值
        $this->assign("list", $list);   //项目数组
        // 输出模板
        $this->display('Index:index');
    }

    public function delete(){
         $caseid = $_GET['caseid'];
         $condition1['id']=$caseid;
         $condition2['caseid']=$caseid;
         $case=M("Case");
         $deletecase=$case->where($condition1)->find();
         $condition4['id']=$deletecase['userid'];
         $user=M("User");
         $deleteuser=$user->where($condition4)->find();
         $username=$deleteuser['email'];
         $case->where($condition1)->delete();
         $caseadd=M("Caseadd");
         $caseadd->where($condition2)->delete();
         $casefocus=M("Casefocus");
         $casefocus->where($condition2)->delete();
         $casejoin=M("Casejoin");
         $casejoin->where($condition2)->delete();
         $caselabel=M("Caselabel");
         $caselabel->where($condition2)->delete();
         $casereply=M("Casereply");
         $casereply->where($condition2)->delete();
         $casestaff=M("Casestaff");
         $casestaff->where($condition2)->delete();
         $diary=M("Diary");
         $diarylabel=M("Diarylabel");
         $diarysupport=M("Diarysupport");
         $temp=$diary->where($condition2)->select();
         foreach ($temp as $key => $value) {
            $condition3['diaryId']=$value['id'];
            $diarylabel->where($condition3)->delete();
            $diarysupport->where($condition3)->delete();
         }
         $diary->where($condition2)->delete();

          $emailto = $username; //接收邮件方
          $emailsubject = "陌筹Tip";//邮件标题 
            //邮件主体内容 
          $emailbody = "亲爱的：<br/>你发起的项目".$deletecase['title']."被管理员删除了";
          SendMail($emailto,$emailsubject,$emailbody);
          $User=A("User");
          $User->index();

    }
}