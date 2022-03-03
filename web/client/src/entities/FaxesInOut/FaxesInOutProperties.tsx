import { PropertySpec } from "lib/services/api/ParsedApiSpecInterface";
import { EntityValue, EntityValues } from "lib/services/entity/EntityService";

export type FaxesInOutPropertyList<T> = {
    'calldate'?: T,
    'fax'?: T,
    'src'?: T,
    'dst'?: T,
    'type'?: T,
    'status'?: T,
    'file'?: T,
};

export type FaxesInOutProperties = FaxesInOutPropertyList<Partial<PropertySpec>>;

export type FaxesInOutPropertiesList = Array<FaxesInOutPropertyList<EntityValue | EntityValues>>;