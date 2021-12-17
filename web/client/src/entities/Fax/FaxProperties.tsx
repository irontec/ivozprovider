import { PropertySpec } from "lib/services/api/ParsedApiSpecInterface";
import { EntityValue, EntityValues } from "lib/services/entity/EntityService";

export type FaxPropertyList<T> = {
    'name'?: T,
    'email'?: T,
    'sendByEmail'?: T,
    'outgoingDdi'?: T,
};

export type FaxProperties = FaxPropertyList<Partial<PropertySpec>>;

export type FaxPropertiesList = Array<FaxPropertyList<EntityValue | EntityValues>>;