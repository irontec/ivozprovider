import { PropertySpec } from "lib/services/api/ParsedApiSpecInterface";
import { EntityValue, EntityValues } from "lib/services/entity/EntityService";

export type HuntGroupsRelUserPropertyList<T> = {
    'huntGroup'?: T,
    'routeType'?: T,
    'numberCountry'?: T,
    'numberValue'?: T,
    'user'?: T,
    'timeoutTime'?: T,
    'priority'?: T,
    'target'?: T,
};

export type HuntGroupsRelUserProperties = HuntGroupsRelUserPropertyList<Partial<PropertySpec>>;

export type HuntGroupsRelUserPropertiesList = Array<HuntGroupsRelUserPropertyList<EntityValue | EntityValues>>;