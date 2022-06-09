import { PropertySpec } from "@irontec/ivoz-ui/services/api/ParsedApiSpecInterface";
import {
  EntityValue,
  EntityValues,
} from "@irontec/ivoz-ui/services/entity/EntityService";

export type SchedulePropertyList<T> = {
  name?: T;
  timeIn?: T;
  timeout?: T;
  monday?: T;
  tuesday?: T;
  wednesday?: T;
  thursday?: T;
  friday?: T;
  saturday?: T;
  sunday?: T;
};

export type ScheduleProperties = SchedulePropertyList<Partial<PropertySpec>>;
export type SchedulePropertiesList = Array<
  SchedulePropertyList<EntityValue | EntityValues>
>;
