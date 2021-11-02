import { PropertySpec } from "lib/services/api/ParsedApiSpecInterface";
import { EntityValue, EntityValues } from "lib/services/entity/EntityService";

type LocutionPropertyList<T> = {
    'name'?: T,
    'originalFile'?: T,
    'status'?: T,
};

export type LocutionProperties = LocutionPropertyList<Partial<PropertySpec>>;
export type LocutionPropertiesList = Array<LocutionPropertyList<EntityValue | EntityValues>>;