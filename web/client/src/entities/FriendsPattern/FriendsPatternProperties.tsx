import { PropertySpec } from "lib/services/api/ParsedApiSpecInterface";
import { EntityValue, EntityValues } from "lib/services/entity/EntityService";

export type FriendsPatternPropertyList<T> = {
    'friend'?: T,
    'name'?: T,
    'regExp'?: T,
};

export type FriendsPatternProperties = FriendsPatternPropertyList<Partial<PropertySpec>>;
export type FriendsPatternPropertiesList = Array<FriendsPatternPropertyList<EntityValue | EntityValues>>;