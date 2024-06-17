import { PropertySpec } from '@irontec-voip/ivoz-ui/services/api/ParsedApiSpecInterface';
import {
  EntityValue,
  EntityValues,
} from '@irontec-voip/ivoz-ui/services/entity/EntityService';

export type FixedCostPropertyList<T> = {
  name?: T;
  description?: T;
  cost?: T;
  id?: T;
};

export type FixedCostProperties = FixedCostPropertyList<Partial<PropertySpec>>;
export type FixedCostPropertiesList = Array<
  FixedCostPropertyList<EntityValue | EntityValues>
>;
