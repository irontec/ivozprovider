import { PropertySpec } from "lib/services/api/ParsedApiSpecInterface";
import { EntityValue, EntityValues } from "lib/services/entity/EntityService";

export type RatingPlanGroupPropertyList<T> = {
};

export type RatingPlanGroupProperties = RatingPlanGroupPropertyList<Partial<PropertySpec>>;
export type RatingPlanGroupPropertiesList = Array<RatingPlanGroupPropertyList<EntityValue | EntityValues>>;