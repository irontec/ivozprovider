import { PropertySpec } from "lib/services/api/ParsedApiSpecInterface";
import { EntityValue, EntityValues } from "lib/services/entity/EntityService";

type RatingProfilePropertyList<T> = {
    'activationTime'?: T
    'ratingPlanGroup'?: T
    'routingTag'?: T
};

export type RatingProfileProperties = RatingProfilePropertyList<Partial<PropertySpec>>;
export type RatingProfilePropertiesList = Array<RatingProfilePropertyList<EntityValue | EntityValues>>;