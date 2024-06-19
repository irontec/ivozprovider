import { PropertySpec } from '@irontec/ivoz-ui/services/api/ParsedApiSpecInterface';
import {
  EntityValue,
  EntityValues,
} from '@irontec/ivoz-ui/services/entity/EntityService';

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
