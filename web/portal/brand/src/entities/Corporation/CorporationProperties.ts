import { PropertySpec } from '@irontec/ivoz-ui/services/api/ParsedApiSpecInterface';
import {
  EntityValue,
  EntityValues,
} from '@irontec/ivoz-ui/services/entity/EntityService';

export type CorporationPropertyList<T> = {
  name?: T;
  description?: T;
  id?: T;
  brand?: T;
};

export type CorporationProperties = CorporationPropertyList<
  Partial<PropertySpec>
>;
export type CorporationPropertiesList = Array<
  CorporationPropertyList<EntityValue | EntityValues>
>;
