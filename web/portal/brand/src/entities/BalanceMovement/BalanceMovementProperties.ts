import { PropertySpec } from '@irontec-voip/ivoz-ui/services/api/ParsedApiSpecInterface';
import {
  EntityValue,
  EntityValues,
} from '@irontec-voip/ivoz-ui/services/entity/EntityService';

export type BalanceMovementPropertyList<T> = {
  amount?: T;
  balance?: T;
  createdOn?: T;
  id?: T;
  company?: T;
  carrier?: T;
};

export type BalanceMovementProperties = BalanceMovementPropertyList<
  Partial<PropertySpec>
>;
export type BalanceMovementPropertiesList = Array<
  BalanceMovementPropertyList<EntityValue | EntityValues>
>;
