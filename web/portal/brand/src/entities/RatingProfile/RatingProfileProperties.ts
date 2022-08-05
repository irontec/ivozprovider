import { PropertySpec } from '@irontec/ivoz-ui/services/api/ParsedApiSpecInterface';
import { EntityValue, EntityValues } from '@irontec/ivoz-ui/services/entity/EntityService';

export type RatingProfilePropertyList<T> = {
  activationTime?: T;
  id?: T;
  company?: T;
  carrier?: T;
  ratingPlanGroup?: T;
  routingTag?: T;
};

export type RatingProfileProperties = RatingProfilePropertyList<Partial<PropertySpec>>;
export type RatingProfilePropertiesList = Array<RatingProfilePropertyList<EntityValue | EntityValues>>;
