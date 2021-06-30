<?php

namespace app\utils\order;

use app\exception\BizException;
use app\model\entity\Order;
use Carbon\Carbon;
use framework\lock\SynLockFactory;

class OrderHelper
{
    /** @var string 发起单 */
    public const PREFIX_FQ = 'FQ';
    /** @var string 节点单 */
    public const PREFIX_JD = 'JD';
    /** @var string 加仓单 */
    public const PREFIX_JC = 'JC';
    /** @var string 游击战单 */
    public const PREFIX_YJZ = 'YJZ';

    /** @var string[] 订单号前缀 */
    public const PREFIX_ARR = [
        Order::ORDER_TYPE_START => self::PREFIX_FQ,
        Order::ORDER_TYPE_NODE => self::PREFIX_JD,
        Order::ORDER_TYPE_ADD => self::PREFIX_JC,
        Order::ORDER_TYPE_GUERRILLA_WAR => self::PREFIX_YJZ,
    ];

    /**
     * 生成订单号
     *
     * @param int    $orderType
     * @param string $numberFormat
     * @param string $dateFormat
     * @return string
     */
    public static function generateNumber(int $orderType, $numberFormat = '%05d', $dateFormat = 'ymd'): string
    {
        $str = '';
        $lock = SynLockFactory::getFileSynLock('order-number');
        $lock->tryLock();
        try {
            $prefix = self::PREFIX_ARR[$orderType];
            $count = (int)Order::query()
                ->where('created_at', '>', date('Y-m-d 00:00:00'))
                ->where('order_type', $orderType)
                ->count();
            $str = Carbon::now()->format($dateFormat) . '_' . sprintf($numberFormat, $count + 1);
        } catch (\Exception $e) {
            $lock->unLock();
            throw new BizException($e->getMessage());
        } finally {
            $lock->unlock();
        }
        return $prefix . '_' . $str;
    }

}
