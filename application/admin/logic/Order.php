<?php
namespace app\admin\logic;

use think\Model;

class Order extends model
{
	public function today(){
		$data[
			'day' =>[ //今天
				'starttime' => strtotime(date("Y-m-d")),
				'endtime'	=> strtotime(date('Y-m-d',strtotime('+1 day'),
			],
			'yesday'=>[ //昨天
				'starttime' => strtotime(date('Y-m-d',strtotime('-1 day'),
				'endtime'	=> 'endtime'	=> strtotime(date('Y-m-d',strtotime('+1 day'),
			],
			'month' =>[ //一个月内
				'starttime' => strtotime(date('Y-m-d',strtotime('-1 month'),
				'endtime'	=> 'endtime'	=> strtotime(date('Y-m-d',strtotime('+1 day'),
			]
			'year' =>[ //一年内
				'starttime' => strtotime(date('Y-m-d',strtotime('-1 year'),
				'endtime'	=> 'endtime'	=> strtotime(date('Y-m-d',strtotime('+1 day'),
			]
			'newmonth' =>[ //这个月
				'starttime' => mktime(0,0,0,date('m'),1,date('Y')),
				'endtime'	=> mktime(23,59,59,date('m'),date('t'),date('Y')),
			]
			'oldmonth' =>[ //上个月
				'starttime' => mktime(0,0,0,date('m')-1,1,date('Y')),
				'endtime'	=> mktime(23,59,59,date('m')-1,data('t'),date('Y')),
			]
			'newyear' =>[ //今年
				'starttime' => mktime(0,0,0,1,1,date('Y')),
				'endtime'	=> mktime(23,59,59,12,31,date('Y')),
			]
			'oldyear' =>[ //去年
				'starttime' => mktime(0,0,0,1,1,date('Y')-1),
				'endtime'	=> mktime(23,59,59,12,31,date('Y')-1),
			]
		];
		foreach ($data as $k_data => $v_data) {
			$data[$key] = index_order($v_data['starttime'],$v_data['endtime'],$id);
		}
		return $data;
	}

	public function index_order($starttime,$endtime){
		$where['set_time'] = ['between',[$starttime,$endtime]];
		$where['set_time'] = ['!=',''];
		$where['status'] = 1;
		//收入
		$price = model('order')->where($where)->sum('order_price');

		//订单数
		$order = model('order')->where($where)->count();

		//套餐数
		$select = model('order')->where($where)->select();
		$arrid = array_column($select,'id');
		$wherecom['order_id'] = ['in',$dayid];
		$wherecom['type'] = 2;
		$wherecom['create_time'] = $where['set_time'];
		$combined = model('order')->where($wherecom)->count();

		//单品数
		$wheregood['order_id'] = ['in',$arrid];
		$wheregood['type=1'] = 1;
		$wheregood['create_time'] = $where['set_time'];
		$good = model('order')->where($wheregood)->count();

		return [
			'price' => $price,
			'order'	=> $order,
			'combined' => $combined,
			'goods' => $goods,
		];
	}
}