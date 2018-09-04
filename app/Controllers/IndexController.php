<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/3
 * Time: 15:55
 */
namespace  app\Controllers;

use hxphp\base\Controller;
use app\models\IndexModel;

class IndexController extends Controller{
    //测试自定义Db查询
    public function index()
    {
        $keyword = isset($_GET['keyword'])??"";
        if($keyword){
            $indexs = (new IndexModel())->search($keyword);
        }else{
            $indexs = (new IndexModel())->where()->order(['id DESC'])->fetchAll();
        }
        $this->assign('title', '全部信息');
        $this->assign('keyword', $keyword);
        $this->assign('indexs', $indexs);
        $this->render();
    }

    //查看单条记录详情
    public function detail($id)
    {
        //通过占位符(?)传入$id参数
        $index = (new IndexModel())->where(["id = ?"], [$id])->fetch();

        $this->assign('title', '详情');
        $this->assign('index', $index);
        $this->render();
    }

    //添加记录，测试Db记录创建
    public function add()
    {
        $access = isset($_POST['value'])??"";
        if(empty($access)) return false;
        $data['item_name'] = $_POST['value'];
        $count = (new IndexModel())->add($data);

        $this->assign('title', '添加成功');
        $this->assign('count', $count);
        $this->render();
    }

    //操作管理
    public function manage($id = 0)
    {
        $index = array();
        if($id){
            //通过占位符传参
            $index = (new IndexModel())->where(["id = :id"], [':id' => $id])->fetch();
        }

        $this->assign('title', '管理');
        $this->assign('index', $index);
        $this->render();
    }

    //更新记录
    public function update()
    {
        $data = array('id' => $_POST['id'], 'item_name' => $_POST['value']);
        $count = (new IndexModel())->where(['id = :id', [':id' => $data['id']]])->update($data);

        $this->assign('title', '修改成功');
        $this->assign('count', $count);
        $this->render();
    }

    //删除记录
    public function delete($id = null)
    {
        $count = (new IndexModel())->delete($id);

        $this->assign('title', '删除成功');
        $this->assign('count', $count);
        $this->render();
    }
}