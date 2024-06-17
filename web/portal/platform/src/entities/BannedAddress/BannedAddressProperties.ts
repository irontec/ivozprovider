import { PropertySpec } from '@irontec-voip/ivoz-ui/services/api/ParsedApiSpecInterface';
import {
  EntityValue,
  EntityValues,
} from '@irontec-voip/ivoz-ui/services/entity/EntityService';

export type BannedAddressPropertyList<T> = {
  ip?: T;
  lastTimeBanned?: T;
  id?: T;
  blocker?: T;
  aor?: T;
};

export type BannedAddressProperties = BannedAddressPropertyList<
  Partial<PropertySpec>
>;
export type BannedAddressPropertiesList = Array<
  BannedAddressPropertyList<EntityValue | EntityValues>
>;
