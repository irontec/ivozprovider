import { PropertySpec } from '@irontec/ivoz-ui/services/api/ParsedApiSpecInterface';
import { EntityValue, EntityValues } from '@irontec/ivoz-ui/services/entity/EntityService';

export type RetailAccountPropertyList<T> = {
};

export type RetailAccountProperties = RetailAccountPropertyList<Partial<PropertySpec>>;
export type RetailAccountPropertiesList = Array<RetailAccountPropertyList<EntityValue | EntityValues>>;