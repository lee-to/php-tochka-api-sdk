<?php

namespace TochkaApi\Resources;

use TochkaApi\Exceptions\ApiException;
use TochkaApi\Models\BaseModel;
use TochkaApi\Models\ModelInterface;

/**
 * Class BaseResource
 * @package TochkaApi\Resources
 */
abstract class BaseResource implements \ArrayAccess, \Countable, ResourceInterface
{
    /**
     * @var array
     */
    private $unknownProperties = [];

    /**
     * @var
     */
    private $model;

    /**
     * @var
     */
    private $_original;


    /**
     * BaseResource constructor.
     * @param ModelInterface $model
     * @param null $data
     */
    public function __construct($model, $data = null)
    {
        $this->setModel($model);

        if (!empty($data) && is_array($data)) {
            $this->fromArray($data);
        }
    }

    /**
     * @return array
     */
    public function getUnknownProperties(): array
    {
        return $this->unknownProperties;
    }

    /**
     * @param array $unknownProperties
     */
    public function setUnknownProperties(array $unknownProperties): void
    {
        $this->unknownProperties = $unknownProperties;
    }


    /**
     * @return mixed|void
     */
    public function getId() {
        return;
    }

    /**
     * @param mixed $model
     */
    public function setModel($model): void
    {
        $this->model = $model;
    }

    /**
     * @return BaseModel
     */
    protected function getModel() {
        return $this->model;
    }

    /**
     * @return mixed
     */
    public function getOriginal()
    {
        return $this->_original;
    }

    /**
     * @param mixed $original
     */
    protected function setOriginal($original): void
    {
        $this->_original = $original;
    }


    /**
     * @param mixed $offset
     * @return bool
     */
    public function offsetExists($offset)
    {
        $method = 'get' . ucfirst($offset);
        if (method_exists($this, $method)) {
            return true;
        }
        $method = 'get' . self::matchPropertyName($offset);
        if (method_exists($this, $method)) {
            return true;
        }
        return array_key_exists($offset, $this->unknownProperties);
    }

    /**
     * @param mixed $offset
     * @return mixed|null
     */
    public function offsetGet($offset)
    {
        $method = 'get' . ucfirst($offset);
        if (method_exists($this, $method)) {
            return $this->{$method} ();
        }
        $method = 'get' . self::matchPropertyName($offset);
        if (method_exists($this, $method)) {
            return $this->{$method} ();
        }
        return array_key_exists($offset, $this->unknownProperties) ? $this->unknownProperties[$offset] : null;
    }

    /**
     * @param mixed $offset
     * @param mixed $value
     */
    public function offsetSet($offset, $value)
    {
        $method = 'set' . ucfirst($offset);
        if (method_exists($this, $method)) {
            $this->{$method}($value);
        } else {
            $method = 'set' . self::matchPropertyName($offset);
            if (method_exists($this, $method)) {
                $this->{$method}($value);
            } else {
                $this->unknownProperties[$offset] = $value;
            }
        }
    }

    /**
     * @param mixed $offset
     */
    public function offsetUnset($offset)
    {
        $method = 'set' . ucfirst($offset);
        if (method_exists($this, $method)) {
            $this->{$method} (null);
        } else {
            $method = 'set' . self::matchPropertyName($offset);
            if (method_exists($this, $method)) {
                $this->{$method} (null);
            } else {
                unset($this->unknownProperties[$offset]);
            }
        }
    }

    /**
     * @param $propertyName
     * @return mixed|null
     */
    public function __get($propertyName)
    {
        return $this->offsetGet($propertyName);
    }

    /**
     * @param $propertyName
     * @param $value
     */
    public function __set($propertyName, $value)
    {
        $this->offsetSet($propertyName, $value);
    }

    /**
     * @param $propertyName
     * @return bool
     */
    public function __isset($propertyName)
    {
        return $this->offsetExists($propertyName);
    }

    /**
     * @param $propertyName
     */
    public function __unset($propertyName)
    {
        $this->offsetUnset($propertyName);
    }

    /**
     * @return bool|string
     */
    public function getClassName() {
        return substr(strrchr(get_class($this), "\\"), 1);
    }

    /**
     * @param $name
     * @param $arguments
     * @return $this
     * @throws ApiException
     */
    public function __call($name, $arguments)
    {
        $targetModelName = '\\TochkaApi\\Models\\' . ucfirst($this->getClassName());

        if(method_exists($this->getModel(), $name)) {
            $this->getModel()->setResource($this);

            return call_user_func_array([$this->getModel(), $name], $arguments);
        } elseif(class_exists($targetModelName)){
            $this->setModel(new $targetModelName($this->getModel()->getApp()));
            $this->getModel()->setResource($this);

            if(method_exists($this->getModel(), $name)) {
                return call_user_func_array([$this->getModel(), $name], $arguments);
            }
        } else {
            throw new ApiException("Method {$name} not found");
        }

        return $this;
    }

    /**
     * @param array $sourceArray
     */
    public function fromArray(array $sourceArray)
    {
        $this->setOriginal($sourceArray);

        foreach ($sourceArray as $key => $value) {
            $this->offsetSet($key, $value);
        }
    }

    /**
     * @param $property
     * @return bool
     */
    private function toArrayObject($property) {
        $method = 'get' . self::matchPropertyName($property);

        if (method_exists($this, $method)) {
            return $this->{$method}();
        }


        return false;
    }

    /**
     * @param $data
     * @param array $array
     * @return array
     */
    private function toArrayRecursive($data, &$array = []){

        if(!is_object($data) && !is_array($data)){
            $array = $data;

            return $array;
        }

        foreach ($data as $property => $value)
        {
            if(!in_array($property, ["model", "unknownProperties", "_original"])) {

                if (!empty($value)) {
                    $array[$property] = [];

                    $this->toArrayRecursive($value, $array[$property]);
                } else {
                    $array[$property] = $this->toArrayObject($property);
                }

            }
        }

        return $array;
    }

    /**
     * @return array|mixed
     */
    public function toArray() {
        return $this->toArrayRecursive($this);
    }

    /**
     * @return false|mixed|string
     */
    public function toJSON() {
        return json_encode($this->toArray());
    }

    /**
     * @param $property
     * @return null|string|string[]
     */
    private static function matchPropertyName($property)
    {
        return preg_replace('/\_(\w)/', '\1', $property);
    }

    /**
     * @return int
     */
    public function count()
    {
        return count($this);
    }
}