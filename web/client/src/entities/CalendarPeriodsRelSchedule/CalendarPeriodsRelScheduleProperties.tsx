import { PropertySpec } from "lib/services/api/ParsedApiSpecInterface";
import { EntityValue, EntityValues } from "lib/services/entity/EntityService";

export type CalendarPeriodsRelSchedulePropertyList<T> = {
    'condition'?: T,
    'schedule'?: T,
};

export type CalendarPeriodsRelScheduleProperties = CalendarPeriodsRelSchedulePropertyList<Partial<PropertySpec>>;
export type CalendarPeriodsRelSchedulePropertiesList = Array<CalendarPeriodsRelSchedulePropertyList<EntityValue | EntityValues>>;