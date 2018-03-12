<?php

namespace Ivoz\Provider\Domain\Model\LcrRule;

use Assert\Assertion;

/**
 * LcrRule
 */
class LcrRule extends LcrRuleAbstract implements LcrRuleInterface
{
    use LcrRuleTrait;

    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet()
    {
        return parent::getChangeSet();
    }

    /**
     * Get id
     * @codeCoverageIgnore
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritDoc}
     */
    public function setRequestUri($requestUri = null)
    {
        if (!empty($requestUri)) {
            Assertion::regex($requestUri, '/^:.+@$/');
        }
        return parent::setRequestUri($requestUri);
    }

    public function setCondition($regexp)
    {
        if (is_numeric($regexp) || $regexp == 'fax') {
            $this->setPrefix($regexp);
            $this->setRequestUri(null);

            return $this;
        }

        $ruriRegexp = $regexp;
        if(substr($ruriRegexp, 0, 1) == '^') {
            $ruriRegexp = ':' . substr($ruriRegexp,1);
        }

        if(substr($ruriRegexp, -1) == '$') {
            $ruriRegexp = substr($ruriRegexp, 0, -1) . '@';
        }

        $this->setRequestUri($ruriRegexp);
        $this->setPrefix(null);

        return $this;
    }
}

