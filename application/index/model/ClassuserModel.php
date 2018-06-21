<?php
// +----------------------------------------------------------------------
// | classmate
// +----------------------------------------------------------------------
// | Author: fangzhihao4 <454114497@qq.com>
// +----------------------------------------------------------------------
namespace app\admin\model;
use think\Model;
class ClassuserModel extends Model
{
    // 确定链接表名
    protected $name = 'classuser';
    /**
     * 根据搜索条件获取列表信息
     * @param $where
     * @param $offset
     * @param $limit
     */
    public function getClassuserByWhere($where, $offset, $limit)
    {
        return $this->alias('classuser')->where($where)->limit($offset, $limit)->order('id desc')->select();
    }
    /**
     * 插入
     * @param $param
     */
    public function insertClassuser($param)
    {
        try{
            $result =  $this->validate('classuser')->save($param);
            if(false === $result){
                // 验证失败 输出错误信息
                return msg(-1, '', $this->getError());
            }else{
                return msg(1, url('user/index'), '添加用户成功');
            }
        }catch(PDOException $e){
            return msg(-2, '', $e->getMessage());
        }
    }
    /**
     * 编辑信息
     * @param $param
     */
    public function editClassuser($param)
    {
        try{
            $result =  $this->validate('classuser')->save($param, ['id' => $param['id']]);
            if(false === $result){
                // 验证失败 输出错误信息
                return msg(-1, '', $this->getError());
            }else{
                return msg(1, url('user/index'), '编辑用户成功');
            }
        }catch(PDOException $e){
            return msg(-2, '', $e->getMessage());
        }
    }
    /**
     * 根据id获取信息
     * @param $id
     */
    public function getOneClassuser($id)
    {
        return $this->where('id', $id)->find();
    }
    /**
     * 删除
     * @param $id
     */
    public function delUser($id)
    {
        try{
            $this->where('id', $id)->delete();
            return msg(1, '', '删除用户成功');
        }catch( PDOException $e){
            return msg(-1, '', $e->getMessage());
        }
    }
    /**
     * 根据用户名获取信息
     * @param $name
     */
    public function findClassuserByName($name)
    {
        return $this->where('name', $name)->find();
    }
    /**
     * 更新
     * @param array $param
     */
    public function upClassuser($param = [], $id)
    {
        try{
            $this->where('id', $id)->update($param);
            return msg(1, '', 'ok');
        }catch (\Exception $e){
            return msg(-1, '', $e->getMessage());
        }
    }
}