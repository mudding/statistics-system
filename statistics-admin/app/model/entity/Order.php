<?php
/**
 * @author: mofh <mofh@pvc123.com>
 * @data  : 2021/1/25
 */

namespace app\model\entity;


use Carbon\Carbon;
use framework\db\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class Order
 *
 * @package app\model\entity
 * @property string|NULL $id
 * @property string|NULL $account_id                   关联的账户Id
 * @property string|NULL $account_type                 账户类型,1=外汇,2=期货,3=期权,4=股票,5=基金,6=美股港股,7=虚拟币
 * @property string|NULL $no                           订单序号(初始单/加仓单，同个序号)
 * @property string|NULL $order_type                   订单类型，1=发起单，2=节点单，3=加仓单(一次一条),4=游击战
 * @property string|NULL $order_status                 订单状态,1=持单中,2=已平部分,3=该条数据全部平仓,4=计划中,5=计划失败
 * @property string|NULL $variety_id                   交易品种Id
 * @property string|NULL $max_loss_amount              最大亏损金额(同个订单序号的最大亏损金额)
 * @property string|NULL $input_signal_time_id         入场信号周期id
 * @property string|NULL $input_hand_count             手数/仓位(单条)
 * @property string|NULL $input_point                  入场点数
 * @property string|NULL $deposit                      保证金
 * @property string|NULL $loss_point                   止损点位
 * @property string|NULL $loss_amount                  该仓位止损金额(单条)
 * @property string|NULL $input_reason                 入场理由
 * @property string|NULL $input_images                 入场图片
 * @property string|NULL $output_hand_count            单条平仓手数/仓位(最后一次)
 * @property string|NULL $output_point                 出场点(最后一次)
 * @property string|NULL $output_amount                单条平仓所得金额(最后一次)
 * @property string|NULL $output_log                   平仓日志(多次平仓记录)
 * @property string|NULL $output_reason                出场理由
 * @property string|NULL $output_images                出场图片
 * @property string|NULL $total                        总金额
 * @property string|NULL $balance                      可用余额
 * @property string|NULL $frozen                       冻结金额
 * @property string|NULL $direction                    订单方向，1-多，0-空
 * @property Carbon      $created_at
 * @property Carbon      $updated_at
 */
class Order extends Model
{
    /* --- 订单类型  --- */
    /** @var int 发起单 */
    public const ORDER_TYPE_START = 1;
    /** @var int 节点单 */
    public const ORDER_TYPE_NODE = 2;
    /** @var int 加仓单 */
    public const ORDER_TYPE_ADD = 3;
    /** @var int 游击战单 */
    public const ORDER_TYPE_GUERRILLA_WAR = 4;
    const ORDER_TYPE = [
        self::ORDER_TYPE_START => '发起单',
        self::ORDER_TYPE_NODE => '节点单',
        self::ORDER_TYPE_ADD => '加仓单',
        self::ORDER_TYPE_GUERRILLA_WAR => '游击战单'
    ];

    /* --- 订单方向  --- */
    const ORDER_DIRECTION_MANY = 1;
    const ORDER_DIRECTION_EMPTY = 0;
    const ORDER_DIRECTION = [
        self::ORDER_DIRECTION_MANY => '多',
        self::ORDER_DIRECTION_EMPTY => '空',
    ];

    /* --- 账户状态  --- */
    /** @var int 持单中 */
    public const ORDER_STATUS_ING = 1;
    /** @var int 已平部分 */
    public const ORDER_STATUS_CLOSE_SOME = 2;
    /** @var int 全平 */
    public const ORDER_STATUS_CLOSE_ALL = 3;
    /** @var int 计划中 */
    public const ORDER_STATUS_PLAN_ING = 4;
    /** @var int 计划失败 */
    public const ORDER_STATUS_PLAN_FAIL = 5;
    const ORDER_STATUS = [
        self::ORDER_STATUS_ING => '持单中',
        self::ORDER_STATUS_CLOSE_SOME => '已平部分仓位',
        self::ORDER_STATUS_CLOSE_ALL => '全平',
        self::ORDER_STATUS_PLAN_ING => '计划中',
        self::ORDER_STATUS_PLAN_FAIL => '计划失败',
    ];

    protected $primaryKey = 'id';

    protected $table = 'order';

    protected $fillable = [
        'id',
        'account_id',
        'account_type',
        'no',
        'direction',
        'order_type',
        'order_status',
        'variety_id',
        'max_loss_amount',
        'input_signal_time_id',
        'input_hand_count',
        'input_point',
        'deposit',
        'loss_point',
        'loss_amount',
        'input_reason',
        'input_images',
        'output_hand_count',
        'output_point',
        'output_amount',
        'output_log',
        'output_reason',
        'output_images',
        'total',
        'balance',
        'frozen',
        'created_at',
        'updated_at'
    ];

    public function orderRelation(): hasMany
    {
        return $this->hasMany(OrderRelation::class, 'order_id', 'id');
    }

    public function variety(): hasOne
    {
        return $this->hasOne(Variety::class, 'id', 'variety_id');
    }

    public function signalTime(): hasOne
    {
        return $this->hasOne(SignalTime::class, 'id', 'input_signal_time_id');
    }
}