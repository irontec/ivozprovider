import { PropertySpec } from '@irontec/ivoz-ui/services/api/ParsedApiSpecInterface';
import {
  EntityValue,
  EntityValues,
} from '@irontec/ivoz-ui/services/entity/EntityService';

export type CallCsvSchedulerPropertyList<T> = {
  name?: T;
  unit?: T;
  frequency?: T;
  callDirection?: T;
  email?: T;
  lastExecution?: T;
  lastExecutionError?: T;
  nextExecution?: T;
  id?: T;
  company?: T;
  callCsvNotificationTemplate?: T;
  ddi?: T;
  carrier?: T;
  retailAccount?: T;
  residentialDevice?: T;
  user?: T;
  fax?: T;
  friend?: T;
  ddiProvider?: T;
};

export type CallCsvSchedulerProperties = CallCsvSchedulerPropertyList<
  Partial<PropertySpec>
>;
export type CallCsvSchedulerPropertiesList = Array<
  CallCsvSchedulerPropertyList<EntityValue | EntityValues>
>;
