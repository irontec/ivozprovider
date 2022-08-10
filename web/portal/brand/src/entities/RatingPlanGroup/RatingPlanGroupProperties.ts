import { PropertySpec } from '@irontec/ivoz-ui/services/api/ParsedApiSpecInterface';
import {
  EntityValue,
  EntityValues,
} from '@irontec/ivoz-ui/services/entity/EntityService';

export type RatingPlanGroupPropertyList<T> = {
  id?: T;
  name?: T;
  description?: T;
  currency?: T;
};

export type RatingPlanGroupProperties = RatingPlanGroupPropertyList<
  Partial<PropertySpec>
>;
export type RatingPlanGroupPropertiesList = Array<
  RatingPlanGroupPropertyList<EntityValue | EntityValues>
>;
