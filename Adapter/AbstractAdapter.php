<?php

namespace Highco\Bundle\RedisBundle\Adapter;

abstract class AbstractAdapter
{
    protected $options = array();
    protected $parameters = array();

    /**
     * __construct
     *
     * @param array $parameters
     * @access public
     * @return void
     */
    public function __construct(array $parameters, array $options = array())
    {
        $this->setParameters($parameters);
        $this->setOptions($options);
    }

    /**
     * generateKey
     *
     * @param mixed $key
     * @access public
     * @return void
     */
    public function generateKey($key, $identifier = null, $suffix = null)
    {
        $values = array();
        $values[] = $this->getOption('prefix', null);
        $values[] = $key;
        $values[] = $identifier;
        $values[] = $suffix;

        return implode(':', array_filter($values));
    }

    /**
     * setparameters
     *
     * @param array $parameters
     * @access public
     * @return void
     */
    public function setParameters(array $parameters)
    {
        $this->parameters = $parameters;
    }

    /**
     * setparameter
     *
     * @param mixed $key
     * @param mixed $value
     * @access public
     * @return void
     */
    public function setParameter($key, $value)
    {
        $this->parameters[$key] = $value;
    }

    /**
     * getparameter
     *
     * @param mixed $key
     * @param mixed $default
     * @access public
     * @return void
     */
    public function getParameter($key, $default = null)
    {
        return isset($this->parameters[$key]) ? $this->parameters[$key] : $default;
    }

    /**
     * getparameters
     *
     * @access public
     * @return void
     */
    public function getParameters()
    {
        return $this->parameters;
    }

    /**
     * setoptions
     *
     * @param array $options
     * @access public
     * @return void
     */
    public function setOptions(array $options)
    {
        $this->options = $options;
    }

    /**
     * setoption
     *
     * @param mixed $key
     * @param mixed $value
     * @access public
     * @return void
     */
    public function setOption($key, $value)
    {
        $this->options[$key] = $value;
    }

    /**
     * getoption
     *
     * @param mixed $key
     * @param mixed $default
     * @access public
     * @return void
     */
    public function getOption($key, $default = null)
    {
        return isset($this->options[$key]) ? $this->options[$key] : $default;
    }

    /**
     * getoptions
     *
     * @access public
     * @return void
     */
    public function getOptions()
    {
        return $this->options;
    }

}
