import { PropertySpec } from '@irontec/ivoz-ui/services/api/ParsedApiSpecInterface';
import {
  EntityValue,
  EntityValues,
} from '@irontec/ivoz-ui/services/entity/EntityService';

export type TrustedPropertyList<T> = {
  srcIp?: T;
  proto?: T;
  fromPattern?: T;
  ruriPattern?: T;
  tag?: T;
  description?: T;
  priority?: T;
  id?: T;
  company?: T;
};

export type TrustedProperties = TrustedPropertyList<Partial<PropertySpec>>;
export type TrustedPropertiesList = Array<
  TrustedPropertyList<EntityValue | EntityValues>
>;
