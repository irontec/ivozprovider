import { PropertySpec } from '@irontec/ivoz-ui/services/api/ParsedApiSpecInterface';
import { EntityValue, EntityValues } from '@irontec/ivoz-ui/services/entity/EntityService';

export type CurrencyPropertyList<T> = {
  iden?: T;
  symbol?: T;
  id?: T;
  name?: T;
};

export type CurrencyProperties = CurrencyPropertyList<Partial<PropertySpec>>;
export type CurrencyPropertiesList = Array<CurrencyPropertyList<EntityValue | EntityValues>>;
