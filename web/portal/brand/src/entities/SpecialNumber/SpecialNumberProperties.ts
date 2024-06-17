import { PropertySpec } from '@irontec-voip/ivoz-ui/services/api/ParsedApiSpecInterface';
import {
  EntityValue,
  EntityValues,
} from '@irontec-voip/ivoz-ui/services/entity/EntityService';

export type SpecialNumberPropertyList<T> = {
  number?: T;
  disableCDR?: T;
  id?: T;
  country?: T;
  global?: T;
};

export type SpecialNumberProperties = SpecialNumberPropertyList<
  Partial<PropertySpec>
>;
export type SpecialNumberPropertiesList = Array<
  SpecialNumberPropertyList<EntityValue | EntityValues>
>;
