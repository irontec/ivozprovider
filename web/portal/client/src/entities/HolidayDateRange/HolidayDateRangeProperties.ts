import { PropertySpec } from '@irontec-voip/ivoz-ui/services/api/ParsedApiSpecInterface';
import {
  EntityValue,
  EntityValues,
} from '@irontec-voip/ivoz-ui/services/entity/EntityService';

export type HolidayDateRangePropertyList<T> = {
  name?: T;
  locution?: T;
  wholeDayEvent?: T;
  timeIn?: T;
  timeOut?: T;
  routeType?: T;
  extension?: T;
  voicemail?: T;
  numberCountry?: T;
  numberValue?: T;
  startDate?: T;
  endDate?: T;
  calendar?: T;
};

export type HolidayDateRangeProperties = HolidayDateRangePropertyList<
  Partial<PropertySpec>
>;
export type HolidayDateRangePropertiesList = Array<
  HolidayDateRangePropertyList<EntityValue | EntityValues>
>;
