import { PropertySpec } from '@irontec/ivoz-ui/services/api/ParsedApiSpecInterface';
import {
  EntityValue,
  EntityValues,
} from '@irontec/ivoz-ui/services/entity/EntityService';

export type CallCsvReportPropertyList<T> = {
  id?: T;
  inDate?: T;
  outDate?: T;
  csv?: T;
  createdOn?: T;
  csv?: T;
  sentTo?: T;
  callCsvScheduler?: T;
  company?: T;
  brand?: T;
};

export type CallCsvReportProperties = CallCsvReportPropertyList<
  Partial<PropertySpec>
>;
export type CallCsvReportPropertiesList = Array<
  CallCsvReportPropertyList<EntityValue | EntityValues>
>;
