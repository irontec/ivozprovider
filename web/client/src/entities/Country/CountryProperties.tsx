import { PropertySpec } from "lib/services/api/ParsedApiSpecInterface";
import { EntityValue, EntityValues } from "lib/services/entity/EntityService";

export type CountryPropertyList<T> = {
    'name'?: T,
    'countryCode'?: T,
};

export type CountryProperties = CountryPropertyList<Partial<PropertySpec>>;
export type CountryPropertiesList = Array<CountryPropertyList<EntityValue|EntityValues>>;