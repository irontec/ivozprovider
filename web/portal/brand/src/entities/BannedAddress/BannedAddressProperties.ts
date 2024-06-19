import { PropertySpec } from '@irontec/ivoz-ui/services/api/ParsedApiSpecInterface';
import {
  EntityValue,
  EntityValues,
} from '@irontec/ivoz-ui/services/entity/EntityService';

export type BannedAddressPropertyList<T> = {
  ip?: T;
  lastTimeBanned?: T;
  id?: T;
  company?: T;
  blocker?: T;
  aor?: T;
  description?: T;
};

export type BannedAddressProperties = BannedAddressPropertyList<
  Partial<PropertySpec>
>;
export type BannedAddressPropertiesList = Array<
  BannedAddressPropertyList<EntityValue | EntityValues>
>;
