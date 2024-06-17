import { PropertySpec } from '@irontec-voip/ivoz-ui/services/api/ParsedApiSpecInterface';
import {
  EntityValue,
  EntityValues,
} from '@irontec-voip/ivoz-ui/services/entity/EntityService';

export type MediaRelaySetPropertyList<T> = {
  description?: T;
  name?: T;
  id?: T;
};

export type MediaRelaySetProperties = MediaRelaySetPropertyList<
  Partial<PropertySpec>
>;
export type MediaRelaySetPropertiesList = Array<
  MediaRelaySetPropertyList<EntityValue | EntityValues>
>;
