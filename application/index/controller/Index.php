<?php
namespace app\index\controller;
use think\Controller;
use think\Db;

class Index extends controller
{
    public function index($id = '')
    {
    	// $id = $_GET($id);
    	$id = 1;
    	// $name = db('pingtuan')->where('id',1)->find();
    	// var_dump($name);
    	if(is_numeric($id)){
    		// $data = 3;
    		$data =  array(  
			    "ren"=>"5",
			    "name"=>"世界级飞科剃须刀ceshi",
			    "type"=> "土豪金",
			    "number"=> "3",
			    "price"=> "158.8",
			    "shifu"=> "48.8"
			);
    	}else{
    		// $data = array("msg" => '403');
    		echo 'msg = 403';
    	}

  //       $group = db('group')->where('user_id',1)->select();


  //       // return $this->fetch();
		// // return json_encode($data);
		// dump($group);
		var_dump($data);
		
		
		
        return '<style type="text/css">*{ padding: 0; margin: 0; } .think_default_text{ padding: 4px 48px;} a{color:#2E5CD5;cursor: pointer;text-decoration: none} a:hover{text-decoration:underline; } body{ background: #fff; font-family: "Century Gothic","Microsoft yahei"; color: #333;font-size:18px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.6em; font-size: 42px }</style><div style="padding: 24px 48px;"> <h1>:)</h1><p> ThinkPHP V5<br/><span style="font-size:30px">十年磨一剑 - 为API开发设计的高性能框架</span></p><span style="font-size:22px;">[ V5.0 版本由 <a href="http://www.qiniu.com" target="qiniu">七牛云</a> 独家赞助发布 ]</span></div><script type="text/javascript" src="https://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script><script type="text/javascript" src="https://e.topthink.com/Public/static/client.js"></script><think id="ad_bd568ce7058a1091"></think>';
    }
    public function tou(){
        $arr['0'] = 0;

        for ($j=0; $j <= 100; $j++) { 
           $arr[$j] = 0;    
        }
        for ($b=0; $b < 1000; $b++) { 
            $arr = $this->foraa($arr);
        }
        arsort($arr);
        dump($arr);
    }
    public function foraa($arr){
        for ($i=0; $i <= 100 ; $i++) { 
            $a = rand(1,10);
            if ($a == 1) {
                $m = $i*1.3 - (100-$i)*10;
            }else{
                $m = (100-$i)*10 - $i*1.3; 
            }
            if($m > 0){
                // echo "   ".$i." ---.. ".$m."\n";
                // echo "<br>";
                foreach ($arr as $key => $value) {
                    // dump($key);dump($value);echo "4234";
                    if ($key == $i) {
                        $arr[$i] = $value+$m;
                    }
                }

            }
        }
        return $arr;
    }
    public function project(){
    	$pro = db('project')->where('status',1)->select();
        $project['selectValue'] = $pro;
        $project['sum'] = 14;
    	// dump($project);
        return json_encode($pro);
    }

    public function lists($id = ''){
    	// dump($id);exit;
    	// $id = $_GET($id);
    	if(!$id){
    		$id = 1;
    	}
    	
    	if(is_numeric($id)){
		$list = db('list')->where('pro_id',$id)->select();
    	}else{
    		echo '403';
    	}
    	dump($list);
    }
    public function hongbao(){
        $hb = db('hongbao')->where('status',1)->select(); 
        // $hb['hongbao'] = count($hb);
        $hongb['hongbao'] = 5;
        $hongb['array'] = $hb;

        return json_encode($hongb);
        // dump($hongb);
    }
} 
