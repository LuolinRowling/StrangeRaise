<?php
namespace Home\Controller;
use Think\Controller;
header("Content-type: text/html; charset=utf-8");
class IndexController extends Controller {
public function index(){
        $Dao = M("Case");
        $Search=M("Caselabel");
        $User=M("User");
        // 查询项目数据
        $list = $Dao->select();
        // 截取Case内容的前100个字
        for($i=0; $i<count($list); $i++) {
            if(strlen($list[$i]['content'])>200) {
                $list[$i]['content'] =  mb_substr($list[$i]['content'], 0, 100,'utf-8');
                $arr = array($list[$i]['content'],'···');
                $list[$i]['content'] = implode($arr);
            }   
        }
        $index=0;
        //$arr=array();
        //根据每个项目id查询标签列表并构造一个二维数组
        foreach ($list as $key2 => $value2) {
            $condition['caseid']=$value2['id'];
            $rs=$User->where("id='%s'",$value2['userid'])->find();
            $nickname=$rs['nickname'];
            $head=$rs['head'];
            $list[$index]['nickname']=$nickname;
            $list[$index]['head']=$head;
            $list[$index]['userid']=$rs['id'];
            $data=$Search->where($condition)->select();

            foreach ($data as $key => $value) {

                $list[$index][]=$value['content'];
            }

            //没查询一个项目的标签，向标签数组追加
            $index=$index+1;
        } 

        // 在首页推荐热门项目
        $recommendcases[0]['caseid'] = 2;
        $recommendcases[0]['title'] = "一次高空拍摄计划";
        $recommendcases[1]['caseid'] = 3;
        $recommendcases[1]['title'] = "小明聚会";
        $recommendcases[2]['caseid'] = 4;
        $recommendcases[2]['title'] = "我来参观你们的网站啦";
        $this->assign("recommendcases", $recommendcases);    //推荐的项目
        
        // 模板变量赋值
        $this->assign("list", $list);   //项目数组
        
        // 输出模板
        $this->display('Index:index');

    }


    //邮箱激活
    function auth() {
        $verify = $_GET['verify'];
        $User=M("User");
        $data=$User->where("ActiCode='%s'",$verify)->find();
        if(!$data) {
            echo "No found";
        } else {
            $data['sign']=C('USER_ACTIVATED');
            $User->where("ActiCode='%s'",$verify)->field('sign')->filter('strip_tags')->save($data);
            $this->display('User:auth');
        }
    }

 //ajax验证注册用户名是否已经存在
    public function ajaxRegister() {
        $username = $_GET['email'];
        $User = M("User");
        $condition['email'] = $username;
        if($User->where($condition)->select() != NULL) {
            $result='AlreadyExist';
            $this->ajaxReturn($result);
        }else{
            $this->ajaxReturn(1);
        }
    }

    //注册
    public function register() {
        $username = $_POST['email'];
        $User = M("User");
        $condition['email'] = $username;
        $User->email = $username;
        if($User->where($condition)->select() != NULL) {
            $this->error("用户名已存在");
        }
        $password= $this->generate_password();
        $User->password =md5($password);
        preg_match('/[^.]+@/',$username,$matches);
        $User->nickname = substr($matches[0],0,strlen($matches[0])-1);
        $User->head = "/mochou/uploads/default.jpg";
        $User->sign = C('USER_INACTIVE');
        $token=md5($username);
        $User->ActiCode = md5($username);
        $result = $User->add();
        if($result >= 1) {
            $emailto = $username; //接收邮件方，本例为注册用户的Email 
            $emailsubject = "欢迎来到陌筹";//邮件标题 
            //邮件主体内容 
            $emailbody = "亲爱的：<br/>欢迎来到陌筹。<br/>请点击链接激活您的帐号。<br/>
            你的密码为".$password."<br/>
            <a href='http://localhost/mochou/index.php/Home/Index/auth?verify=".$token."' target=
            '_blank'>http://localhost/mochou/index.php/Home/Index/auth?verify=".$token."</a><br/>
             如果以上链接无法点击，请将它复制到你的浏览器地址栏中进入访问.";
            if(SendMail($emailto,$emailsubject,$emailbody))
                $this->success("发送成功，前往邮箱验证");
            else
                $this->error("注册失败!");
        } else {
            $this->error("注册失败");
        }
    }

    //生成密码
    private function generate_password( $length = 8 ) {
        // 密码字符集，可任意添加你需要的字符
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';

        $password = '';
        for ( $i = 0; $i < $length; $i++ ) {
            // 这里提供两种字符获取方式
            // 第一种是使用 substr 截取$chars中的任意一位字符；
            // 第二种是取字符数组 $chars 的任意元素
            // $password .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
            $password .= $chars[ mt_rand(0, strlen($chars) - 1) ];
        }

        return $password;
    }

    
    //登录用户名ajax验证
    public function ajaxLogin() {
        $username = $_GET['username'];
        $User = M("User");
        $rs=$User->where("email='%s'",$username)->find();
        $result;
        if(!$rs) {
            $result='NOexist';
            $this->ajaxReturn($result);
        } else if($rs['sign']==1000) {
            $result='GOTO your mailbox please';
            $this->ajaxReturn($result);
        } else {
            $this->ajaxReturn(1);
        }
    }   

    //登录
    public function login() {
        $username = $_GET['username'];
        //$temp=$_POST['password'];
        $password=$_GET['password'];
        $User = M("User");
        $rs=$User->where("email='%s'",$username)->find();
        if($rs['password']!=$password) {
            $this->ajaxReturn('Password Wrong!');
        } else {
            session('username',$username);
            session('id',$rs['id']);
            session('nickname',$rs['nickname']);

            if($rs['head']!=null) {
                session('head', $rs['head']);
            } else {
                session('head', "/uploads/default.jpg");
            }

            $this->ajaxReturn(110);
        }
    }


}