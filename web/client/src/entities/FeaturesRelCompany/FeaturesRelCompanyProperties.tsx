import { PropertySpec } from "lib/services/api/ParsedApiSpecInterface";
import { EntityValue, EntityValues } from "lib/services/entity/EntityService";

export type featuresRelCompanyPropertyList<T> = {
    'feature'?: T,
};

export type featuresRelCompanyProperties = featuresRelCompanyPropertyList<Partial<PropertySpec>>;

export type featuresRelCompanyPropertiesList = Array<featuresRelCompanyPropertyList<EntityValue | EntityValues>>;