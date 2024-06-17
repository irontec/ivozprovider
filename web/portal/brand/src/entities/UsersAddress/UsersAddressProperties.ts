import { PropertySpec } from '@irontec-voip/ivoz-ui/services/api/ParsedApiSpecInterface';
import {
  EntityValue,
  EntityValues,
} from '@irontec-voip/ivoz-ui/services/entity/EntityService';

export type UsersAddressPropertyList<T> = {
  sourceAddress?: T;
  description?: T;
  id?: T;
  company?: T;
  ipAddr?: T;
  mask?: T;
  port?: T;
  tag?: T;
};

export type UsersAddressProperties = UsersAddressPropertyList<
  Partial<PropertySpec>
>;
export type UsersAddressPropertiesList = Array<
  UsersAddressPropertyList<EntityValue | EntityValues>
>;
