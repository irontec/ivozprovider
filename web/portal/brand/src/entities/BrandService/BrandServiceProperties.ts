import { PropertySpec } from '@irontec/ivoz-ui/services/api/ParsedApiSpecInterface';
import { EntityValue, EntityValues } from '@irontec/ivoz-ui/services/entity/EntityService';

export type BrandServicePropertyList<T> = {
  code?: T;
  id?: T;
  service?: T;
};

export type BrandServiceProperties = BrandServicePropertyList<Partial<PropertySpec>>;
export type BrandServicePropertiesList = Array<BrandServicePropertyList<EntityValue | EntityValues>>;
