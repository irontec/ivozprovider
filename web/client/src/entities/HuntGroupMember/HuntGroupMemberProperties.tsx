import { PropertySpec } from '@irontec/ivoz-ui/services/api/ParsedApiSpecInterface';
import { EntityValue, EntityValues } from '@irontec/ivoz-ui/services/entity/EntityService';

export type HuntGroupMemberPropertyList<T> = {
  'huntGroup'?: T,
  'routeType'?: T,
  'numberCountry'?: T,
  'numberValue'?: T,
  'user'?: T,
  'timeoutTime'?: T,
  'priority'?: T,
  'target'?: T,
};

export type HuntGroupMemberProperties = HuntGroupMemberPropertyList<Partial<PropertySpec>>;

export type HuntGroupMemberPropertiesList = Array<HuntGroupMemberPropertyList<EntityValue | EntityValues>>;