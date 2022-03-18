import { PropertySpec } from "@irontec/ivoz-ui/services/api/ParsedApiSpecInterface";
import { EntityValue, EntityValues } from "@irontec/ivoz-ui/services/entity/EntityService";

export type CalendarPeriodPropertyList<T> = {
    'calendar'?: T,
    'startDate'?: T,
    'endDate'?: T,
    'scheduleIds'?: T,
    'locution'?: T,
    'routeType'?: T,
    'numberCountry'?: T,
    'numberValue'?: T,
    'voicemail'?: T,
    'extension'?: T,
    'target'?: T,
};

export type CalendarPeriodProperties = CalendarPeriodPropertyList<Partial<PropertySpec>>;
export type CalendarPeriodPropertiesList = Array<CalendarPeriodPropertyList<EntityValue | EntityValues>>;