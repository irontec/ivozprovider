import { PropertySpec } from '@irontec/ivoz-ui/services/api/ParsedApiSpecInterface';
import { EntityValue, EntityValues } from '@irontec/ivoz-ui/services/entity/EntityService';

export type UsersAddressPropertyList<T> = {
  sourceAddress?: T;
  description?: T;
  id?: T;
  company?: T;
};

export type UsersAddressProperties = UsersAddressPropertyList<Partial<PropertySpec>>;
export type UsersAddressPropertiesList = Array<UsersAddressPropertyList<EntityValue | EntityValues>>;
