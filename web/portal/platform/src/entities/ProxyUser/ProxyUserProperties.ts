import { PropertySpec } from '@irontec/ivoz-ui/services/api/ParsedApiSpecInterface';
import {
  EntityValue,
  EntityValues,
} from '@irontec/ivoz-ui/services/entity/EntityService';

export type ProxyUserPropertyList<T> = {
  name?: T;
  id?: T;
  ip?: T;
};

export type ProxyUserProperties = ProxyUserPropertyList<Partial<PropertySpec>>;
export type ProxyUserPropertiesList = Array<
  ProxyUserPropertyList<EntityValue | EntityValues>
>;
