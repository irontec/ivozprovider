<?php

namespace Ivoz\Provider\Domain\Model\LcrRule;

/**
 * LcrRule
 */
class LcrRule extends LcrRuleAbstract implements LcrRuleInterface
{
    use LcrRuleTrait;

    public function getChangeSet()
    {
        return parent::getChangeSet();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
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

