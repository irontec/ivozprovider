<?php

class IvozProvider_Klear_Filter_RouteTag extends IvozProvider_Klear_Filter_Brand
{
    public function setRouteDispatcher(KlearMatrix_Model_RouteDispatcher $routeDispatcher)
    {
        parent::setRouteDispatcher($routeDispatcher);
        $companyId = $routeDispatcher->getParam("parentId", false);

        if (!$companyId) {
            return;
        }

        /** @var \Ivoz\Core\Application\Service\DataGateway $dataGateway */
        $dataGateway = \Zend_Registry::get('data_gateway');

        /** @var \Ivoz\Provider\Domain\Model\CompanyRelRoutingTag\CompanyRelRoutingTagDto $tags */
        $tags = $dataGateway->findBy(
            \Ivoz\Provider\Domain\Model\CompanyRelRoutingTag\CompanyRelRoutingTag::class,
            ["CompanyRelRoutingTag.company = '$companyId'"]
        );

        $tagIds = array_map(function ($tag) { return $tag->getRoutingtagId(); }, $tags);;
        $this->_condition[] = "self::id in (''," . implode(",", $tagIds) . ")";

        return true;
    }

}
