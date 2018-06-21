<?php
namespace app\index\model;

use think\Model;

class CarModel extends Model
{
	// 确定链接表名
    protected $name = 'car';
    /**
     * 根据搜索条件获取列表信息
     * @param $where
     * @param $offset
     * @param $limit
     */
    public function getCarByWhere($where, $offset, $limit)
    {
        return $this->alias('car')->where($where)->limit($offset, $limit)->order('id desc')->select();
    }
    /**
     * 插入信息
     * @param $param
     */
    public function insertCar($param)
    {
        try{
            $result =  $this->validate('car')->save($param);
            if(false === $result){
                // 验证失败 输出错误信息
                return msg(-1, '', $this->getError());
            }else{
                return msg(1, url('user/index'), '添加成功');
            }
        }catch(PDOException $e){
            return msg(-2, '', $e->getMessage());
        }
    }
    /**
     * 编辑信息
     * @param $param
     */
    public function editCar($param)
    {
        try{
            $result =  $this->validate('car')->save($param, ['id' => $param['id']]);
            if(false === $result){
                // 验证失败 输出错误信息
                return msg(-1, '', $this->getError());
            }else{
                return msg(1, url('user/index'), '编辑成功');
            }
        }catch(PDOException $e){
            return msg(-2, '', $e->getMessage());
        }
    }
    /**
     * 根据id获取信息
     * @param $id
     */
    public function getOneCar($id)
    {
        return $this->where('id', $id)->find();
    }
    /**
     * 删除
     * @param $id
     */
    public function delCar($id)
    {
        try{
            $this->where('id', $id)->delete();
            return msg(1, '', '删除成功');
        }catch( PDOException $e){
            return msg(-1, '', $e->getMessage());
        }
    }
    /**
     * 更新
     * @param array $param
     */
    public function upCar($param = [], $id)
    {
        try{
            $this->where('id', $id)->update($param);
            return msg(1, '', 'ok');
        }catch (\Exception $e){
            return msg(-1, '', $e->getMessage());
        }
    }
}