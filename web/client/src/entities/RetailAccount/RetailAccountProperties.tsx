import { PropertySpec } from "lib/services/api/ParsedApiSpecInterface";
import { EntityValue, EntityValues } from "lib/services/entity/EntityService";

export type RetailAccountPropertyList<T> = {
};

export type RetailAccountProperties = RetailAccountPropertyList<Partial<PropertySpec>>;
export type RetailAccountPropertiesList = Array<RetailAccountPropertyList<EntityValue | EntityValues>>;