import { PropertySpec } from '@irontec/ivoz-ui/services/api/ParsedApiSpecInterface';
import {
  EntityValue,
  EntityValues,
} from '@irontec/ivoz-ui/services/entity/EntityService';

export type FaxesInOutPropertyList<T> = {
  calldate?: T;
  fax?: T;
  src?: T;
  dstCountry?: T;
  dst?: T;
  type?: T;
  status?: T;
  file?: T;
};

export type FaxesInOutProperties = FaxesInOutPropertyList<
  Partial<PropertySpec>
>;

export type FaxesInOutPropertiesList = Array<
  FaxesInOutPropertyList<EntityValue | EntityValues>
>;
