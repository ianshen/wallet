<?php

class Controller_Index extends Controller_Abstract {
    
    private $walletId = 0;
    
    public function init() {
        $this->walletId = 536;
    }
    
    public function index() {
        $db = Santa_Db::pool ( 'wallet' );
        $wallet = $db->findOne ( "select * from `wallet` where id={$this->walletId}" );
        if ($this->isAjax ()) {
            $amount = intval ( Santa_Context::form ( 'amount' ) );
            check_empty ( $amount, 100001, '数额?' );
            $usage = Santa_Context::form ( 'usage' );
            check_empty ( $usage, 100001, '用途?' );
            $type = Santa_Context::form ( 'type' );
            if ($type == 2) {
                $amount = - $amount;
            }
            $money = $wallet ['money'];
            $money += $amount;
            $result = $db->insert ( 'record', array (
                'wallet_id' => $this->walletId, 
                'amount' => $amount, 
                'usage' => $usage, 
                'wallet_money' => $money, 
                'type' => $type 
            ) );
            if ($result === false) {
                ajaxRender ( 100001, '失败' );
            }
            //更新余额
            $result = $db->update ( 'wallet', array (
                'money' => $money 
            ), "id={$this->walletId}" );
            if ($result === false) {
                ajaxRender ( 100001, '失败' );
            }
            ajaxRender ( 100000, 'o' );
        }
        $list = $db->findAll ( "select * from record where wallet_id={$this->walletId} order by ctime desc" );
        $this->assign ( 'list', $list );
        $this->assign ( 'wallet', $wallet );
        $this->display ();
    }
    
    public function debt() {
    
    }
    
    public function create_wallet() {
        $money = intval ( Santa_Context::param ( 'action' ) );
        $user = $_SESSION ['user'];
        $db = Santa_Db::pool ( 'wallet' );
        $result = $db->insert ( 'wallet', array (
            'user_id' => $user ['id'], 
            'name' => $name, 
            'money' => $money, 
            'member_count' => 1 
        ) );
        if ($result === false) {
            ajaxRender ( 100001, '失败' );
        }
        ajaxRender ( 100000, 'o' );
    }
    
    public function delete_wallet() {
        $walletId = intval ( Santa_Context::param ( 'action' ) );
        $user = $_SESSION ['user'];
        $db = Santa_Db::pool ( 'wallet' );
        $result = $db->delete ( 'wallet', "id={$walletId}" );
        if ($result === false) {
            ajaxRender ( 100001, '失败' );
        }
        ajaxRender ( 100000, 'o' );
    }
    
    public function del_record() {
        if ($this->isAjax ()) {
            $db = Santa_Db::pool ( 'wallet' );
            $id = intval ( Santa_Context::form ( 'action' ) );
            $result = $db->update ( 'record', array (
                'status' => 0 
            ), "id={$id}" );
            ajaxRender ( 100000, 'o' );
        }
    }
    
    /**
     * 设置钱包余额
     */
    public function setsum() {
        $num = intval ( Santa_Context::param ( 'action' ) );
        check_empty ( $num, 100001, '数额?' );
        $db = Santa_Db::pool ( 'wallet' );
        $result = $db->update ( 'wallet', array (
            'money' => $num 
        ), "id={$this->walletId}" );
        if ($result === false) {
            ajaxRender ( 100001, '失败' );
        }
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