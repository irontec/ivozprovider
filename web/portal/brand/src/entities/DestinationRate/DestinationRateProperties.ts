import { PropertySpec } from '@irontec-voip/ivoz-ui/services/api/ParsedApiSpecInterface';
import {
  EntityValue,
  EntityValues,
} from '@irontec-voip/ivoz-ui/services/entity/EntityService';

export type DestinationRatePropertyList<T> = {
  cost?: T;
  costCurrency?: T;
  connectFee?: T;
  connectFeeCurrency?: T;
  rateIncrement?: T;
  groupIntervalStart?: T;
  id?: T;
  destinationRateGroup?: T;
  destination?: T;
  currencySymbol?: T;
};

export type DestinationRateProperties = DestinationRatePropertyList<
  Partial<PropertySpec>
>;
export type DestinationRatePropertiesList = Array<
  DestinationRatePropertyList<EntityValue | EntityValues>
>;
