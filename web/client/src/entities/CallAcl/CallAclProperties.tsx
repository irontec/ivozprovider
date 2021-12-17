import { PropertySpec } from "lib/services/api/ParsedApiSpecInterface";
import { EntityValue, EntityValues } from "lib/services/entity/EntityService";

export type CallAclPropertyList<T> = {
    'attr'?: T,
    'name'?: T,
    'defaultPolicy'?: T,
};

export type CallAclProperties = CallAclPropertyList<Partial<PropertySpec>>;
export type CallAclPropertiesList = Array<CallAclPropertyList<EntityValue|EntityValues>>;