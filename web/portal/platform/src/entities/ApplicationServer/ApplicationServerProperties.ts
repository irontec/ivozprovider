import { PropertySpec } from '@irontec-voip/ivoz-ui/services/api/ParsedApiSpecInterface';
import {
  EntityValue,
  EntityValues,
} from '@irontec-voip/ivoz-ui/services/entity/EntityService';

export type ApplicationServerPropertyList<T> = {
  name?: T;
  ip?: T;
  id?: T;
};

export type ApplicationServerProperties = ApplicationServerPropertyList<
  Partial<PropertySpec>
>;
export type ApplicationServerPropertiesList = Array<
  ApplicationServerPropertyList<EntityValue | EntityValues>
>;
