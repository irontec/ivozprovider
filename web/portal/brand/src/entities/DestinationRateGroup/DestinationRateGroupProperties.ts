import { PropertySpec } from '@irontec/ivoz-ui/services/api/ParsedApiSpecInterface';
import {
  EntityValue,
  EntityValues,
} from '@irontec/ivoz-ui/services/entity/EntityService';

export type DestinationRateGroupPropertyList<T> = {
  status?: T;
  lastExecutionError?: T;
  deductibleConnectionFee?: T;
  id?: T;
  name?: T;
  description?: T;
  file?: T;
  currency?: T;
};

export type DestinationRateGroupProperties = DestinationRateGroupPropertyList<
  Partial<PropertySpec>
>;
export type DestinationRateGroupPropertiesList = Array<
  DestinationRateGroupPropertyList<EntityValue | EntityValues>
>;
