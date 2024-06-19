import { PropertySpec } from '@irontec/ivoz-ui/services/api/ParsedApiSpecInterface';
import {
  EntityValue,
  EntityValues,
} from '@irontec/ivoz-ui/services/entity/EntityService';

export type InvoicePropertyList<T> = {
  number?: T;
  inDate?: T;
  outDate?: T;
  total?: T;
  taxRate?: T;
  totalWithTax?: T;
  status?: T;
  statusMsg?: T;
  id?: T;
  pdf?: T;
  invoiceTemplate?: T;
  brand?: T;
  company?: T;
  currency?: T;
};

export type InvoiceProperties = InvoicePropertyList<Partial<PropertySpec>>;
export type InvoicePropertiesList = Array<
  InvoicePropertyList<EntityValue | EntityValues>
>;
