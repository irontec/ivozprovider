import { PropertySpec } from '@irontec-voip/ivoz-ui/services/api/ParsedApiSpecInterface';
import {
  EntityValue,
  EntityValues,
} from '@irontec-voip/ivoz-ui/services/entity/EntityService';

export type ServicePropertyList<T> = {
  defaultCode?: T;
  description?: T;
  name?: T;
  iden?: T;
  id?: T;
  extraArgs?: T;
};

export type ServiceProperties = ServicePropertyList<Partial<PropertySpec>>;
export type ServicePropertiesList = Array<
  ServicePropertyList<EntityValue | EntityValues>
>;
