import { PropertySpec } from '@irontec/ivoz-ui/services/api/ParsedApiSpecInterface';
import { EntityValue, EntityValues } from '@irontec/ivoz-ui/services/entity/EntityService';

export type CalendarPropertyList<T> = {
  'name'?: T,
};

export type CalendarProperties = CalendarPropertyList<Partial<PropertySpec>>;
export type CalendarPropertiesList = Array<CalendarPropertyList<EntityValue | EntityValues>>;