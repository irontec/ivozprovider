import { PropertySpec } from '@irontec/ivoz-ui/services/api/ParsedApiSpecInterface';
import {
  EntityValue,
  EntityValues,
} from '@irontec/ivoz-ui/services/entity/EntityService';

export type ProxyTrunkPropertyList<T> = {
  name?: T;
  ip?: T;
  id?: T;
};

export type ProxyTrunkProperties = ProxyTrunkPropertyList<
  Partial<PropertySpec>
>;
export type ProxyTrunkPropertiesList = Array<
  ProxyTrunkPropertyList<EntityValue | EntityValues>
>;
