<?php

/**
 * @author: mofh <mofh@pvc123.com>
 * @data  : 2021/4/27
 */

namespace app\model\entity;

use Carbon\Carbon;
use framework\db\Model;
use function Symfony\Component\String\s;

/**
 * Class OrderEndEvaluate
 *
 * @package app\model\entity
 * @property string|NULL $id
 * @property string|NULL $order_id                                订单id
 * @property string|NULL $system_risk                             系统根据公式自评风险，1-合理，2-重仓
 * @property string|NULL $is_success                              自评该订单是否成功，1-成功，2-失败
 * @property string|NULL $order_evaluate                          订单评价
 * @property string|NULL $is_done_system                          是否按照系统做单，1-是，2-否
 * @property string|NULL $is_stop_loss                            离场的原因是否触碰止损离场，1-是，2-否'
 * @property string|NULL $is_normal_stop_loss                     设置的止损是否合理，1-合理，2-不合理（不止损/窄止损）
 * @property string|NULL $is_leaving_too_early                    是否过早离场，1-是，2-否
 * @property string|NULL $is_normal_point                         手数是否正常，1-是，2-否
 * @property string|NULL $is_free                                 是否自在，1-是，2-否
 * @property string|NULL $mood_evaluate                           情绪评价
 * @property Carbon      $created_at
 * @property Carbon      $updated_at
 */
class OrderEndEvaluate extends Model
{

    /** @var int 系统风控-合理仓位 */
    const SYSTEM_RISK_RATIONAL = 1;
    /** @var int 系统风控-重仓 */
    const SYSTEM_RISK_HEAVY = 2;
    const SYSTEM_RISK = [
        self::SYSTEM_RISK_RATIONAL => '合理仓位',
        self::SYSTEM_RISK_HEAVY => '重仓'
    ];

    /** @var int 自评该订单-成功 */
    const IS_SUCCESS = 1;
    /** @var int 自评该订单-失败 */
    const IS_FAIL = 2;
    const ORDER_IS_SUCCESS = [
        self::IS_SUCCESS => '成功',
        self::IS_FAIL => '失败'
    ];

    /** @var int 是否按照系统做单-是 */
    const IS_DONE_SYSTEM_YES = 1;
    /** @var int 是否按照系统做单-否 */
    const IS_DONE_SYSTEM_NOT = 2;
    const IS_DONE_SYSTEM = [
        self::IS_DONE_SYSTEM_YES => '是',
        self::IS_DONE_SYSTEM_NOT => '否'
    ];

    /** @var int 是否触碰止损离场-是 */
    const IS_STOP_LOSS_YES = 1;
    /** @var int 是否触碰止损离场-否 */
    const IS_STOP_LOSS_NOT = 2;
    const IS_STOP_LOSS = [
        self::IS_STOP_LOSS_YES => '是',
        self::IS_STOP_LOSS_NOT => '否'
    ];

    /** @var int 设置的止损是否合理-合理 */
    const IS_NORMAL_STOP_LOSS_RATIONAL = 1;
    /** @var int 设置的止损是否合理-不合理（不止损/窄止损） */
    const IS_NORMAL_STOP_LOSS_NOT_RATIONAL = 2;
    const IS_NORMAL_STOP_LOSS = [
        self::IS_NORMAL_STOP_LOSS_RATIONAL => '合理',
        self::IS_NORMAL_STOP_LOSS_NOT_RATIONAL => '不合理（不止损/窄止损）'
    ];

    /** @var int 是否过早离场-是 */
    const IS_LEAVING_TOO_EARLY_YES = 1;
    /** @var int 是否过早离场-否 */
    const IS_LEAVING_TOO_EARLY_NOT = 2;
    const IS_LEAVING_TOO_EARLY = [
        self::IS_LEAVING_TOO_EARLY_YES => '是',
        self::IS_LEAVING_TOO_EARLY_NOT => '否'
    ];

    /** @var int 手数是否正常-是 */
    const IS_NORMAL_POINT_YES = 1;
    /** @var int 手数是否正常-否 */
    const IS_NORMAL_POINT_NOT = 2;
    const IS_NORMAL_POINT = [
        self::IS_NORMAL_POINT_YES => '是',
        self::IS_NORMAL_POINT_NOT => '否'
    ];

    /** @var int 是否自在-是 */
    const IS_FREE_YES = 1;
    /** @var int 是否自在-否 */
    const IS_FREE_NOT = 2;
    const IS_FREE = [
        self::IS_FREE_YES => '是',
        self::IS_FREE_NOT => '否'
    ];

    protected $primaryKey = 'id';

    protected $table = 'order_end_evaluate';

    protected $fillable = [
        'id',
        'order_id',
        'system_risk',
        'is_success',
        'order_evaluate',
        'is_done_system',
        'is_stop_loss',
        'is_normal_stop_loss',
        'is_leaving_too_early',
        'is_normal_point',
        'is_free',
        'mood_evaluate',
        'created_at',
        'updated_at'
    ];
}