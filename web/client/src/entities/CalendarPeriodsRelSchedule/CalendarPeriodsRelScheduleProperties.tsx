import { PropertySpec } from "@irontec/ivoz-ui/services/api/ParsedApiSpecInterface";
import {
  EntityValue,
  EntityValues,
} from "@irontec/ivoz-ui/services/entity/EntityService";

export type CalendarPeriodsRelSchedulePropertyList<T> = {
  condition?: T;
  schedule?: T;
};

export type CalendarPeriodsRelScheduleProperties =
  CalendarPeriodsRelSchedulePropertyList<Partial<PropertySpec>>;
export type CalendarPeriodsRelSchedulePropertiesList = Array<
  CalendarPeriodsRelSchedulePropertyList<EntityValue | EntityValues>
>;
