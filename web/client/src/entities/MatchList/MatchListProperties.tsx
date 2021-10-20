import { PropertySpec } from "lib/services/api/ParsedApiSpecInterface";
import { EntityValue, EntityValues } from "lib/services/entity/EntityService";

type MatchListPropertyList<T> = {
    'name'?: T,
};

export type MatchListProperties = MatchListPropertyList<Partial<PropertySpec>>;
export type MatchListPropertiesList = Array<MatchListPropertyList<EntityValue | EntityValues>>;