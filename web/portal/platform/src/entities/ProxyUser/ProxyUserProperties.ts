import { PropertySpec } from '@irontec-voip/ivoz-ui/services/api/ParsedApiSpecInterface';
import {
  EntityValue,
  EntityValues,
} from '@irontec-voip/ivoz-ui/services/entity/EntityService';

export type ProxyUserPropertyList<T> = {
  name?: T;
  id?: T;
  ip?: T;
  advertisedIp?: T;
};

export type ProxyUserProperties = ProxyUserPropertyList<Partial<PropertySpec>>;
export type ProxyUserPropertiesList = Array<
  ProxyUserPropertyList<EntityValue | EntityValues>
>;
