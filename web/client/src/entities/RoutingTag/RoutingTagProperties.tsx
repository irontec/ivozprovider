import { PropertySpec } from "lib/services/api/ParsedApiSpecInterface";
import { EntityValue, EntityValues } from "lib/services/entity/EntityService";

export type RoutingTagPropertyList<T> = {
    'name'?: T,
    'tag'?: T,
};

export type RoutingTagProperties = RoutingTagPropertyList<Partial<PropertySpec>>;
export type RoutingTagPropertiesList = Array<RoutingTagPropertyList<EntityValue | EntityValues>>;