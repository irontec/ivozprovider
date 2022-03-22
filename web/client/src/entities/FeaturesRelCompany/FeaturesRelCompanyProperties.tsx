import { PropertySpec } from "@irontec/ivoz-ui/services/api/ParsedApiSpecInterface";
import { EntityValue, EntityValues } from "@irontec/ivoz-ui/services/entity/EntityService";

export type featuresRelCompanyPropertyList<T> = {
    'feature'?: T,
};

export type featuresRelCompanyProperties = featuresRelCompanyPropertyList<Partial<PropertySpec>>;

export type featuresRelCompanyPropertiesList = Array<featuresRelCompanyPropertyList<EntityValue | EntityValues>>;