import { PropertySpec } from '@irontec/ivoz-ui/services/api/ParsedApiSpecInterface';
import { EntityValue, EntityValues } from '@irontec/ivoz-ui/services/entity/EntityService';

export type InvoiceSchedulerPropertyList<T> = {
  name?: T;
  unit?: T;
  frequency?: T;
  email?: T;
  lastExecution?: T;
  lastExecutionError?: T;
  nextExecution?: T;
  taxRate?: T;
  id?: T;
  invoiceTemplate?: T;
  brand?: T;
  company?: T;
  numberSequence?: T;
};

export type InvoiceSchedulerProperties = InvoiceSchedulerPropertyList<Partial<PropertySpec>>;
export type InvoiceSchedulerPropertiesList = Array<InvoiceSchedulerPropertyList<EntityValue | EntityValues>>;
