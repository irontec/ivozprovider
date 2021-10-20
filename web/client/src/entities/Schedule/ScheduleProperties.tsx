import { PropertySpec } from "lib/services/api/ParsedApiSpecInterface";
import { EntityValue, EntityValues } from "lib/services/entity/EntityService";

type SchedulePropertyList<T> = {
    'name'?: T,
    'timeIn'?: T,
    'timeout'?: T,
    'monday'?: T,
    'tuesday'?: T,
    'wednesday'?: T,
    'thursday'?: T,
    'friday'?: T,
    'saturday'?: T,
    'sunday'?: T,
};

export type ScheduleProperties = SchedulePropertyList<Partial<PropertySpec>>;
export type SchedulePropertiesList = Array<SchedulePropertyList<EntityValue | EntityValues>>;