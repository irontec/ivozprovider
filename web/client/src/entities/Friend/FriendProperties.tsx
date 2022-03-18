import { PropertySpec } from "@irontec/ivoz-ui/services/api/ParsedApiSpecInterface";
import { EntityValue, EntityValues } from "@irontec/ivoz-ui/services/entity/EntityService";

export type FriendPropertyList<T> = {
    'name'?: T,
    'domain'?: T,
    'description'?: T,
    'transport'?: T,
    'ip'?: T,
    'port'?: T,
    'password'?: T,
    'callAcl'?: T,
    'transformationRuleSet'?: T,
    'outgoingDdi'?: T,
    'priority'?: T,
    'disallow'?: T,
    'allow'?: T,
    'directMediaMethod'?: T,
    'calleridUpdateHeader'?: T,
    'updateCallerid'?: T,
    'fromDomain'?: T,
    'fromUser'?: T,
    'directConnectivity'?: T,
    'ddiIn'?: T,
    'language'?: T,
    't38Passthrough'?: T,
    'alwaysApplyTransformations'?: T,
    'rtpEncryption'?: T,
    'multiContact'?: T,
    'statusIcon'?: T,
};

export type FriendProperties = FriendPropertyList<Partial<PropertySpec>>;
export type FriendPropertiesList = Array<FriendPropertyList<EntityValue | EntityValues>>;