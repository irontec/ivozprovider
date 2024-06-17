import { PropertySpec } from '@irontec-voip/ivoz-ui/services/api/ParsedApiSpecInterface';
import {
  EntityValue,
  EntityValues,
} from '@irontec-voip/ivoz-ui/services/entity/EntityService';

export type MusicOnHoldPropertyList<T> = {
  name?: T;
  originalFile?: T;
};

export type MusicOnHoldProperties = MusicOnHoldPropertyList<
  Partial<PropertySpec>
>;
export type MusicOnHoldPropertiesList = Array<
  MusicOnHoldPropertyList<EntityValue | EntityValues>
>;
