<?php
namespace app\admin\model;

use think\Model;

class Order extends Model
{
	// 确定链接表名
    protected $name = 'order';

    /**
     * 新增
     * @param $param
     */
    public function insertOrder($param)
    {	
        Db::startTrans();
		try{
		    $this->validate('order')->insert($param);
		    $return = $this->getLastInsID();
		    // 提交事务
		    Db::commit();  
		    return $return;
		} catch (\Exception $e) {
		    // 回滚事务
		    Db::rollback();
		    return false;
		}
    }
    
    /**
     * 编辑信息
     * @param $param
     */
    public function editOrder($param)
    {
    	Db::startTrans();
		try{
		    $this->validate('Order')->save($param, ['id' => $param['id']]);
		    // 提交事务
		    Db::commit();
		    return true;   
		} catch (\Exception $e) {
		    // 回滚事务
		    Db::rollback();
		    return false;
		}
		return $return;
    }

    /**
     * 根据id获取信息
     * @param $id
     */
    public function getOrder($id)
    {
        return $this->where('id', $id)->find();
    }
    
    /**
     * 根据订单号获取信息
     * @param $orderno
     */
    public function findOrderByOrderno($orderno)
    {
        return $this->where('order_no', $orderno)->find();
    }

    /**
     * 根据条件获取多条信息
     * @param $where
     */
    public function selectOrderByWhere($where)
    {
        return $this->where($where)->select();
    }

    /**
     * 更新
     * @param array $param
     */
    public function upOrder($param = [], $id)
    {
		Db::startTrans();
		try{
		    $return = $this->where('id', $id)->update($param);
		    // 提交事务
		    Db::commit();
		    return true;   
		} catch (\Exception $e) {
		    // 回滚事务
		    Db::rollback();
		    return false;
		}
		return $return;
    }
    

}