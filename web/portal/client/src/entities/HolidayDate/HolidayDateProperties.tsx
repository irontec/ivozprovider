import { PropertySpec } from '@irontec/ivoz-ui/services/api/ParsedApiSpecInterface';
import {
  EntityValue,
  EntityValues,
} from '@irontec/ivoz-ui/services/entity/EntityService';

export type HolidayDatePropertyList<T> = {
  calendar?: T;
  name?: T;
  eventDate?: T;
  locution?: T;
  wholeDayEvent?: T;
  timeIn?: T;
  timeOut?: T;
  routeType?: T;
  numberCountry?: T;
  numberValue?: T;
  voicemail?: T;
  extension?: T;
  target?: T;
};

export type HolidayDateProperties = HolidayDatePropertyList<
  Partial<PropertySpec>
>;
export type HolidayDatePropertiesList = Array<
  HolidayDatePropertyList<EntityValue | EntityValues>
>;
