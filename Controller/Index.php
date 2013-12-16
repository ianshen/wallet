<?php

class Controller_Index extends Controller_Abstract {
    
    private $sum_file = 'sum.dat';
    
    public function init() {
    
    }
    
    public function index() {
        $db = Santa_Db::pool ( 'wallet' );
        if ($this->isAjax ()) {
            $amount = intval ( Santa_Context::form ( 'amount' ) );
            check_empty ( $amount, 100001, '数额?' );
            $usage = Santa_Context::form ( 'usage' );
            check_empty ( $usage, 100001, '用途?' );
            $type = Santa_Context::form ( 'type' );
            $result = $db->insert ( 'record', array (
                'amount' => $amount, 
                'usage' => $usage, 
                'type' => $type 
            ) );
            if ($result === false) {
                ajaxRender ( 100001, '' );
            }
            ajaxRender ( 100000, 'o' );
        }
        $list = $db->findAll ( "select * from record order by ctime desc" );
        $group = $db->findOne ( "select * from `group` where id=536" );
        $this->assign ( 'list', $list );
        $this->assign ( 'group', $group );
        $this->assign ( 'str', '#%这是测试模板字符串变量%%' );
        $this->display ();
    }
    
    public function delrecord() {
        if ($this->isAjax ()) {
            $db = Santa_Db::pool ( 'wallet' );
            $id = intval ( Santa_Context::form ( 'action' ) );
            //$result = $db->delete ( 'record', "id={$id}" );
            $result = $db->update ( 'record', array (
                'status' => 0 
            ), "id={$id}" );
            ajaxRender ( 100000, 'o' );
        }
    }
    
    public function mjson() {
        $data = base64_decode ( trim ( $_GET ['sdx'] ) );
        $data = json_decode ( $data, true );
        $url = $data ['uri_mob'];
        $json = array (
                'version' => 'v3',
                'from' => $data ['from'],
                'fromurl' => $url,
                'title' => $data ['title'],
                'titleurl' => $url,
                'datetime' => $data ['time'],
                'content' => $data ['summary'],
                'contenturl' => $url,
                'desc' => '',
                'descurl' => $url
        );
        $json = json_encode ( $json );
        echo $json;
    }
    /**
     * 设置余额
     */
    public function setsum() {
        $num = intval ( Santa_Context::param ( 'action' ) );
        if (! file_exists ( $this->sum_file )) {
            file_put_contents ( $this->sum_file, "0\n", FILE_APPEND );
        }
        file_put_contents ( $this->sum_file, $num . "\n", FILE_APPEND );
        ajaxRender ( 100000, 'o' );
    }
    
    /**
     * 数据库池测试
     */
    public function db() {
        /* 数据库池测试 */
        //从池中根据别名获取连接资源
        //print_r ( Santa_Db::$_pool );
        $db = Santa_Db::pool ( 'test' );
        //使用query方法操作数据
        $result = $db->query ( "select * from test1" );
        print_r ( $result );
        $result = $db->query ( "insert into test1(value) values('hahahaa')" );
        print_r ( $result );
        $result = $db->query ( "update test1 set value='hohohooo' where id=21" );
        print_r ( $result );
        $result = $db->query ( "delete from test1 where id=21" );
        print_r ( $result );
        //使用简单封装的方法操作数据
        //获取一条数据
        $result = $db->findOne ( "select * from test1 where id=3" );
        print_r ( $result );
        //获取全部数据
        $result = $db->findAll ( "select * from test1" );
        print_r ( $result );
        //使用select获取数据
        $result = $db->select ( 'test1', array (
            'where' => 'id=3' 
        ) );
        print_r ( $result );
        //插入数据
        $result = $db->insert ( 'test1', array (
            'value' => 'xxx' 
        ) );
        print_r ( $result );
        //更新数据
        $result = $db->update ( 'test1', array (
            'value' => 'xxxxy' 
        ), 'id=10' );
        print_r ( $result );
        //删除数据
        $result = $db->delete ( 'test1', 'id=11' );
        print_r ( $result );
        //查询记录数
        $result = $db->count ( 'test1', "value='hahahaa'" );
        print_r ( $result );
    }
    
    public function test() {
        echo __METHOD__;
    }
}