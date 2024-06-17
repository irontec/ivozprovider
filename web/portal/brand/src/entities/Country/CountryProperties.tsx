import { PropertySpec } from '@irontec-voip/ivoz-ui/services/api/ParsedApiSpecInterface';
import {
  EntityValue,
  EntityValues,
} from '@irontec-voip/ivoz-ui/services/entity/EntityService';

export type CountryPropertyList<T> = {
  id?: T;
  name?: T;
  countryCode?: T;
};

export type CountryProperties = CountryPropertyList<Partial<PropertySpec>>;
export type CountryPropertiesList = Array<
  CountryPropertyList<EntityValue | EntityValues>
>;
