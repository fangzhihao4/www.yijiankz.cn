<?php
// +----------------------------------------------------------------------
// | classmate
// +----------------------------------------------------------------------
// | Author: fangzhihao4 <454114407@qq.com>
// +----------------------------------------------------------------------
namespace app\index\model;
use think\Model;
class UserModel extends Model
{
    // 确定链接表名
    protected $name = 'user';
    /**
     * 插入信息
     * @param $param
     */
    public function insertUser($param)
    {
        try{
            $result =  $this->validate('User')->save($param);
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
    public function editUser($param)
    {
        try{
            $result =  $this->validate('User')->save($param, ['id' => $param['id']]);
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
    public function getUser($id)
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
            return msg(1, '', '删除成功');
        }catch( PDOException $e){
            return msg(-1, '', $e->getMessage());
        }
    }
    /**
     * 根据用户名获取信息
     * @param $name
     */
    public function findUserByName($name)
    {
        return $this->where('username', $name)->find();
    }
    /**
     * 更新
     * @param array $param
     */
    public function upUser($param = [], $id)
    {
        try{
            $this->where('id', $id)->update($param);
            return msg(1, '', 'ok');
        }catch (\Exception $e){
            return msg(-1, '', $e->getMessage());
        }
    }
}