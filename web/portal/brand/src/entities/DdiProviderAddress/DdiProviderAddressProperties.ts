import { PropertySpec } from '@irontec/ivoz-ui/services/api/ParsedApiSpecInterface';
import { EntityValue, EntityValues } from '@irontec/ivoz-ui/services/entity/EntityService';

export type DdiProviderAddressPropertyList<T> = {
  ip?: T;
  description?: T;
  id?: T;
  ddiProvider?: T;
};

export type DdiProviderAddressProperties = DdiProviderAddressPropertyList<Partial<PropertySpec>>;
export type DdiProviderAddressPropertiesList = Array<DdiProviderAddressPropertyList<EntityValue | EntityValues>>;
