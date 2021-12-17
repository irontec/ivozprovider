import { PropertySpec } from "lib/services/api/ParsedApiSpecInterface";
import { EntityValue, EntityValues } from "lib/services/entity/EntityService";

export type PickUpGroupPropertyList<T> = {
    'name'?: T,
    'userIds'?: T,
};

export type PickUpGroupProperties = PickUpGroupPropertyList<Partial<PropertySpec>>;
export type PickUpGroupPropertiesList = Array<PickUpGroupPropertyList<EntityValue | EntityValues>>;