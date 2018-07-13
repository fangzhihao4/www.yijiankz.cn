<?php
// +----------------------------------------------------------------------
// | yijiankz
// +----------------------------------------------------------------------
// | Author: fangzhihao4 <454114407@qq.com>
// +----------------------------------------------------------------------
namespace app\admin\model;

use think\Model;
use think\validate;
use think\db;

class Admin extends Model
{
	// 确定链接表名
    protected $name = 'admin';

    /**
     * 插入信息
     * @param $param
     */
    public function insertAdmin($param)
    {	
        Db::startTrans();
		try{
		    $this->validate('admin')->insert($param);
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
    public function editAdmin($param)
    {
    	Db::startTrans();
		try{
		    $this->validate('admin')->save($param, ['id' => $param['id']]);
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
    public function getAdmin($id)
    {
        return $this->where('id', $id)->find();
    }
    /**
     * 删除
     * @param $id
     */
    public function delAdmin($id)
    {
    	Db::startTrans();
		try{
		    $this->where('id', $id)->delete();
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
     * 根据昵称获取信息
     * @param $name
     */
    public function findAdminByName($name)
    {
        return $this->where('name', $name)->find();
    }

    /**
     * 根据用户名获取信息
     * @param $name
     */
    public function findAdminByUsername($name)
    {
        return $this->where('username', $name)->find();
    }
    /**
     * 更新
     * @param array $param
     */
    public function upAdmin($param = [], $id)
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