<?php

namespace Ledc\XiaoHongShu\Notify;

use Closure;
use InvalidArgumentException;
use SplObjectStorage;
use SplObserver;
use SplSubject;

/**
 * 小红书推送回调通知主题
 */
abstract class XhsNotifySubject implements SplSubject
{
    /**
     * 已注册添加的观察者对象
     * @var SplObjectStorage
     */
    private SplObjectStorage $observers;
    /**
     * 小红书推送回调通知报文
     * @var XhsNotify
     */
    private XhsNotify $notify;
    /**
     * 待注册添加的观察者类
     * @var array|class-string[]|SplObserver[]
     */
    protected array $register = [];

    /**
     * 构造函数
     * @param XhsNotify $notify
     */
    public function __construct(XhsNotify $notify)
    {
        $this->observers = new SplObjectStorage();
        $this->notify = $notify;
        $this->initialize();
        $this->registerObserver();
    }

    /**
     * 子类初始化
     * @return void
     */
    abstract protected function initialize(): void;

    /**
     * 添加观察者
     * @param SplObserver $observer 观察者对象
     * @return void
     */
    final public function attach(SplObserver $observer): void
    {
        $this->observers->attach($observer);
    }

    /**
     * 删除观察者
     * @param SplObserver $observer 观察者对象
     * @return void
     */
    final public function detach(SplObserver $observer): void
    {
        $this->observers->detach($observer);
    }

    /**
     * 获取订单状态回调的数据报文
     * @return XhsNotify 订单状态回调的数据报文
     */
    final public function getNotify(): XhsNotify
    {
        return $this->notify;
    }

    /**
     * 通知观察者
     * @return void
     */
    final public function notify(): void
    {
        /** @var SplObserver $observer */
        foreach ($this->observers as $observer) {
            $observer->update($this);
        }
    }

    /**
     * 添加观察者
     * @return void
     */
    final private function registerObserver(): void
    {
        foreach ($this->register as $class) {
            if ($class instanceof SplObserver) {
                $this->attach($class);
            } elseif (is_string($class) && class_exists($class)) {
                $this->attach(new $class);
            } elseif ($class instanceof Closure) {
                $this->attach(new class($class) implements SplObserver {
                    /**
                     * @var Closure
                     */
                    private Closure $closure;

                    /**
                     * 构造函数
                     * @param Closure $closure
                     */
                    public function __construct(Closure $closure)
                    {
                        $this->closure = $closure;
                    }

                    /**
                     * 更新
                     * @param SplSubject $subject
                     * @return void
                     */
                    public function update(SplSubject $subject): void
                    {
                        ($this->closure)($subject);
                    }
                });
            } else {
                throw new InvalidArgumentException('观察者类必须是 SplObserver 或字符串');
            }
        }
    }
}