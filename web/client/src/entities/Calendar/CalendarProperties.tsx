import { PropertySpec } from "lib/services/api/ParsedApiSpecInterface";
import { EntityValue, EntityValues } from "lib/services/entity/EntityService";

export type CalendarPropertyList<T> = {
    'name'?: T,
};

export type CalendarProperties = CalendarPropertyList<Partial<PropertySpec>>;
export type CalendarPropertiesList = Array<CalendarPropertyList<EntityValue|EntityValues>>;