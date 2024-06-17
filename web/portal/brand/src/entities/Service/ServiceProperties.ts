import { PropertySpec } from '@irontec-voip/ivoz-ui/services/api/ParsedApiSpecInterface';
import {
  EntityValue,
  EntityValues,
} from '@irontec-voip/ivoz-ui/services/entity/EntityService';

export type ServicePropertyList<T> = {
  iden?: T;
  defaultCode?: T;
  extraArgs?: T;
  id?: T;
  name?: T;
  description?: T;
};

export type ServiceProperties = ServicePropertyList<Partial<PropertySpec>>;
export type ServicePropertiesList = Array<
  ServicePropertyList<EntityValue | EntityValues>
>;
