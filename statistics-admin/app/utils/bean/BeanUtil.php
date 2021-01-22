<?php

namespace app\utils\bean;

use Exception;
use framework\util\ModelTransformUtils;

/**
 * Class BeanUtil.
 */
class BeanUtil
{
    /**
     * @param $class
     * @param array $array
     *
     * @return object
     *
     * array--->bean
     */
    public static function transToBean($class, $array = [])
    {
        try {
            return ModelTransformUtils::map2Model($class, $array);
        } catch (Exception $exception) {
            return new $class();
        }
    }

    /**
     * bean--->array
     * @param $model
     * @return array
     */
    public static function transToMap($model)
    {
        try {
            return ModelTransformUtils::model2Map($model);
        } catch (Exception $exception) {
            return [];
        }
    }

    /**
     * @param $class
     * @param array $beans
     *
     * @return array
     *               array list --->bean
     */
    public static function transToBeanList($class, $beans = []): array
    {
        $resultList = [];
        foreach ($beans ?? [] as $bean) {
            $resultList[] = static::transToBean($class, $bean);
        }

        return $resultList;
    }

    /**
     * bean list--->array list
     * @param array $models
     * @return array
     */
    public static function transToMapList(array $models)
    {
        $resultList = [];
        foreach ($models ?? [] as $model) {
            $resultList[] = static::transToMap($model);
        }
        return $resultList;
    }
}
