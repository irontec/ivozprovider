import { PropertySpec } from '@irontec-voip/ivoz-ui/services/api/ParsedApiSpecInterface';
import {
  EntityValue,
  EntityValues,
} from '@irontec-voip/ivoz-ui/services/entity/EntityService';

export type RatingPlanPropertyList<T> = {
  weight?: T;
  timingType?: T;
  timeIn?: T;
  monday?: T;
  tuesday?: T;
  wednesday?: T;
  thursday?: T;
  friday?: T;
  saturday?: T;
  sunday?: T;
  id?: T;
  ratingPlanGroup?: T;
  destinationRateGroup?: T;
};

export type RatingPlanProperties = RatingPlanPropertyList<
  Partial<PropertySpec>
>;
export type RatingPlanPropertiesList = Array<
  RatingPlanPropertyList<EntityValue | EntityValues>
>;
