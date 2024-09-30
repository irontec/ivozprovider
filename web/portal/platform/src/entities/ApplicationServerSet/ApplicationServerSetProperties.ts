import { PropertySpec } from '@irontec/ivoz-ui/services/api/ParsedApiSpecInterface';
import {
  EntityValue,
  EntityValues,
} from '@irontec/ivoz-ui/services/entity/EntityService';

export type ApplicationServerSetPropertyList<T> = {
  id?: T;
  name?: T;
  distributeMethod?: T;
  description?: T;
  applicationServers?: T;
};

export type ApplicationServerSetProperties = ApplicationServerSetPropertyList<
  Partial<PropertySpec>
>;
export type ApplicationServerSetPropertiesList = Array<
  ApplicationServerSetPropertyList<EntityValue | EntityValues>
>;
