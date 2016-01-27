<?php
namespace Addons\PayMent\Think;
/**
 * 通用支付接口类
 * @author yunwuxin<448901948@qq.com>
 */

class Pay {

    /**
     * 支付驱动实例
     * @var Object
     */
    private $payer;

    /**
     * 配置参数
     * @var type 
     */
    private $config;

    /**
     * 构造方法，用于构造上传实例
     * @param string $driver 要使用的支付驱动
     * @param array  $config 配置
     */
    public function __construct($driver, $config = array()) {
        /* 配置 */
        $pos = strrpos($driver, '\\');
        $pos = $pos === false ? 0 : $pos + 1;
        $apitype = strtolower(substr($driver, $pos));
        $this->config['notify_url'] = U("Home/Public/notify", array('apitype' => $apitype, 'method' => 'notify'), false, true);
        $this->config['return_url'] = U("Home/Public/notify", array('apitype' => $apitype, 'method' => 'return'), false, true);
        $config = array_merge($this->config, $config);

        /* 设置支付驱动 */
        $class = strpos($driver, '\\') ? $driver : 'Think\\Pay\\Driver\\' . ucfirst(strtolower($driver));
        $this->setDriver($class, $config);
    }

    public function buildRequestForm(Pay\PayVo $vo) {
        $this->payer->check();
        //生成本地记录数据
        $check = M("Pay")->add(array(
            'out_trade_no' => $vo->getOrderNo(),
            'money' => $vo->getFee(),
            'status' => 0,
            'callback' => $vo->getCallback(),
            'url' => $vo->getUrl(),
            'param' => serialize($vo->getParam()),
            'create_time' => time(),
            'update_time' => time()
        ));

        if ($check !== false) {
            return $this->payer->buildRequestForm($vo);
        } else {
            E(M("Pay")->getDbError());
        }
    }

    /**
     * 设置支付驱动
     * @param string $class 驱动类名称
     */
    private function setDriver($class, $config) {
        $this->payer = new $class($config);

        if (!$this->payer) {
            E("不存在支付驱动：{$class}");
        }
    }

    public function __call($method, $arguments) {
        // dump($method);
        // dump($arguments);
        // dump($this->payer);
        // dump($this->payer instanceof Pay\Pay);
        // dump(method_exists($this->payer, $method));
        // exit;
        if (method_exists($this, $method)) {
            return call_user_func_array(array(&$this, $method), $arguments);
        } elseif (!empty($this->payer) && method_exists($this->payer, $method)) {
            return call_user_func_array(array(&$this->payer, $method), $arguments);
        }else{
            echo 'jskdjfksadfkasdk';
        }
    }

}
