<?php

class Controller_Index extends Controller_Abstract {
    
    public function init() {
        $this->filters ['controller'] = array (
            'checkLogin' => 1, 
            'isChinaMobile' => 1, 
            't' => 0 
        );
        $this->filters ['action'] ['index'] = array (
            'checkLogin' => 1, 
            'isChinaMobile' => 1 
        );
        $this->filters ['action'] ['test'] = array (
            't' => 1 
        );
        $this->filters ['action'] ['context'] = array (
            'checkLogin' => 0, 
            'isChinaMobile' => 0 
        );
        Santa_Context::set ( 'user', array (
            'firstname' => 'ian', 
            'lastname' => 'shen' 
        ) );
    }
    
    public function index() {
        //var_dump ( $this->getViewEngine () );
        //$this->_view->name='ianshen';
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
            ajaxRender ( 100000, 'o' );
        }
        $list = $db->findAll ( "select * from record order by ctime desc" );
        $this->assign ( 'list', $list );
        $this->assign ( 'str', '#%这是测试模板字符串变量%%' );
        $this->display ();
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
    
    /**
     * 缓存池测试
     */
    public function cache() {
        /* 缓存池测试 */
        $mc = Santa_Cache::pool ( 'userinfo' );
        $mc->set ( 'haha', 'haaaaaaaaa' );
        print_r ( $mc->get ( 'haha' ) );
        $mc->set ( 'xxx', array (
            'id' => 3, 
            'name' => 'ian' 
        ) );
        print_r ( $mc->get ( 'xxx' ) );
        var_dump ( $mc->delete ( 'haha' ) );
        var_dump ( $mc->delete ( 'haha' ) );
        
        $mc->set ( 'kkk', 3 );
        var_dump ( $mc->increment ( 'kkk' ) );
        var_dump ( $mc->increment ( 'kkk' ) );
        var_dump ( $mc->increment ( 'kkk' ) );
        var_dump ( $mc->decrement ( 'kkk', 17 ) );
        var_dump ( $mc->get ( 'kkk' ) );
        print_r ( $mc->stats () );
        //文件缓存测试
        $fc = Santa_Cache::pool ( 'file1' );
        $fc->set ( 'haha', 'haaaaaaaaa' );
        print_r ( $fc->get ( 'haha' ) );
        var_dump ( $fc->del ( 'haha' ) );
    }
    
    public function test() {
        echo __METHOD__;
    }
    
    /**
     * 上下文Santa_Context测试
     */
    public function context() {
        echo '获取在init()中设置的user上下文变量<br>';
        $user = Santa_Context::get ( 'user' );
        print_r ( $user );
        Santa_Context::set ( 'xxx', 'jsflsdjdfs' );
        Santa_Context::set ( 'xxxx', 'jsflsdjdfs' );
        Santa_Context::set ( 'xxxxx', 'jsflsdjdfs' );
        echo '<br>查看所有的上下文变量<br>';
        print_r ( Santa_Context::$_data );
    }
    
    /**
     * 筛选器
     * 
     */
    public function t() {
        echo __METHOD__;
    }
    
    /**
     * 筛选器
     * 检查是否登录
     */
    public function checkLogin() {
        echo __METHOD__;
    }
    
    /**
     * 筛选器
     * 检查是否移动用户
     */
    public function isChinaMobile() {
        echo __METHOD__;
    }
    
    /**
     * Smarty引擎测试
     * 此处的入口文件要使用smarty.php,smarty.php/index/smarty
     */
    public function smarty() {
        /* $engine = $this->getViewEngine ();
		print_r ( $engine ); */
        $this->assign ( 'name', 'Smarty引擎测试页' );
        $this->display ( 'smarty/index.html' );
    }
}