import { PropertySpec } from '@irontec/ivoz-ui/services/api/ParsedApiSpecInterface';
import {
  EntityValue,
  EntityValues,
} from '@irontec/ivoz-ui/services/entity/EntityService';

export type DdiProviderPropertyList<T> = {
  description?: T;
  name?: T;
  id?: T;
  brand?: T;
  proxyTrunk?: T;
  mediaRelaySets?: T;
};

export type DdiProviderProperties = DdiProviderPropertyList<
  Partial<PropertySpec>
>;
export type DdiProviderPropertiesList = Array<
  DdiProviderPropertyList<EntityValue | EntityValues>
>;
