import { PropertySpec } from '@irontec/ivoz-ui/services/api/ParsedApiSpecInterface';
import {
  EntityValue,
  EntityValues,
} from '@irontec/ivoz-ui/services/entity/EntityService';

export type AdministratorRelPublicEntityPropertyList<T> = {
  create?: T;
  read?: T;
  update?: T;
  delete?: T;
  id?: T;
  administrator?: T;
  publicEntity?: T;
};

export type AdministratorRelPublicEntityProperties =
  AdministratorRelPublicEntityPropertyList<Partial<PropertySpec>>;
export type AdministratorRelPublicEntityPropertiesList = Array<
  AdministratorRelPublicEntityPropertyList<EntityValue | EntityValues>
>;
