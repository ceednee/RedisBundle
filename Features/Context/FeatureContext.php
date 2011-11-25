<?php

namespace Highco\Bundle\RedisBundle\Features\Context;

use Behat\BehatBundle\Context\BehatContext,
    Behat\BehatBundle\Context\MinkContext;
use Behat\Behat\Context\ClosuredContextInterface,
    Behat\Behat\Context\TranslatedContextInterface,
    Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;
use Highco\Bundle\CurlBundle\Util\ResultAtom;
use Symfony\Component\HttpKernel\HttpKernelInterface;

require_once 'PHPUnit/Autoload.php';
require_once 'PHPUnit/Framework/Assert/Functions.php';

/**
 * Feature context.
 */
class FeatureContext extends BehatContext //MinkContext if you want to test web
{
    protected $adapter;
    protected $output;
    protected $entity;

    /**
     * @Given /^I use service "([^"]*)" for "([^"]*)" attribute$/
     */
    public function iUseServiceForAdapter($service, $attribute)
    {
        $this->$attribute = $this->getContainer()->get($service);
    }

    /**
     * @When /^I call "([^"]*)" on adapter with arguments:$/
     */
    public function iCallOnAdapterWithArguments($method, TableNode $args)
    {
        $args = $args->getHash();
        $args = array_pop($args);

        $key = $this->adapter->generateKey($args['key']);

        switch($method)
        {
            case 'set':
                $this->output = $this->adapter->set($key, $args['value']);
            break;
            case 'get':
                $this->output = $this->adapter->get($key);
            break;
            case 'del':
                $this->output = $this->adapter->del($key);
            break;
        }
    }

    /**
     * @Then /^I should have "([^"]*)" equals to "([^"]*)"$/
     */
    public function iShouldHaveEqualsTo($attribute, $value)
    {
        assertTrue($this->$attribute == $value);
    }

    /**
     * @Given /^I use class "([^"]*)" for "([^"]*)" attribute$/
     */
    public function iUseClassForAttribute($class, $attribute)
    {
        $this->$attribute = new $class();
    }

    /**
     * @Given /^I hydrate "([^"]*)" with values:$/
     */
    public function iHydrateWithValues($attribute, TableNode $table)
    {
        $attrs = $table->getHash();
        $this->$attribute->hydrate(array_pop($attrs));
    }

    /**
     * @When /^I persist entity with format "([^"]*)"$/
     */
    public function iPersistEntityWithFormat($format)
    {
        $this->output = $this->persister->persist($this->entity, $format);
    }

}
