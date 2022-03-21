import { PropertySpec } from "lib/services/api/ParsedApiSpecInterface";
import { EntityValue, EntityValues } from "lib/services/entity/EntityService";

export type UserPropertyList<T> = {
    'name'?: T,
    'lastname'?: T,
    'email'?: T,
    'pass'?: T,
    'active'?: T,
    'timezone'?: T,
    'transformationRuleSet'?: T,
    'terminal'?: T,
    'extension'?: T,
    'outgoingDdi'?: T,
    'outgoingDdiRule'?: T,
    'callAcl'?: T,
    'doNotDisturb'?: T,
    'isBoss'?: T,
    'bossAssistant'?: T,
    'bossAssistantWhiteList'?: T,
    'maxCalls'?: T,
    'pickupGroupIds'?: T,
    'language'?: T,
    'externalIpCalls'?: T,
    'rejectCallMethod'?: T,
    'gsQRCode'?: T,
    'multiContact'?: T,
};

export type UserProperties = UserPropertyList<Partial<PropertySpec>>;
export type UserPropertiesList = Array<UserPropertyList<EntityValue | EntityValues>>;
