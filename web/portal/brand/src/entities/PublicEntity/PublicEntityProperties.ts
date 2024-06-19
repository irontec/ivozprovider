import { PropertySpec } from '@irontec/ivoz-ui/services/api/ParsedApiSpecInterface';
import {
  EntityValue,
  EntityValues,
} from '@irontec/ivoz-ui/services/entity/EntityService';

export type PublicEntityPropertyList<T> = {
  iden?: T;
  fqdn?: T;
  platform?: T;
  brand?: T;
  client?: T;
  id?: T;
  name?: T;
};

export type PublicEntityProperties = PublicEntityPropertyList<
  Partial<PropertySpec>
>;
export type PublicEntityPropertiesList = Array<
  PublicEntityPropertyList<EntityValue | EntityValues>
>;
