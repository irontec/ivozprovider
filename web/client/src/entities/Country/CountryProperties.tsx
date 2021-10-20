import { PropertySpec } from "lib/services/api/ParsedApiSpecInterface";
import { EntityValue, EntityValues } from "lib/services/entity/EntityService";

type CountryPropertyList<T> = {
    'name'?: T,
};

export type CountryProperties = CountryPropertyList<Partial<PropertySpec>>;
export type CountryPropertiesList = Array<CountryPropertyList<EntityValue|EntityValues>>;