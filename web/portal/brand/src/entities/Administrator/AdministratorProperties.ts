import { PropertySpec } from '@irontec/ivoz-ui/services/api/ParsedApiSpecInterface';
import { EntityValue, EntityValues } from '@irontec/ivoz-ui/services/entity/EntityService';

export type AdministratorPropertyList<T> = {
  username?: T;
  pass?: T;
  email?: T;
  active?: T;
  restricted?: T;
  name?: T;
  lastname?: T;
  id?: T;
  company?: T;
  timezone?: T;
};

export type AdministratorProperties = AdministratorPropertyList<Partial<PropertySpec>>;
export type AdministratorPropertiesList = Array<AdministratorPropertyList<EntityValue | EntityValues>>;
