import { PropertySpec } from '@irontec/ivoz-ui/services/api/ParsedApiSpecInterface';
import { EntityValue, EntityValues } from '@irontec/ivoz-ui/services/entity/EntityService';

export type CountryPropertyList<T> = {
  'name'?: T,
  'countryCode'?: T,
};

export type CountryProperties = CountryPropertyList<Partial<PropertySpec>>;
export type CountryPropertiesList = Array<CountryPropertyList<EntityValue | EntityValues>>;