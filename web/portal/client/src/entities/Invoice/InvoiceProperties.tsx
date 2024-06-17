import { PropertySpec } from '@irontec-voip/ivoz-ui/services/api/ParsedApiSpecInterface';
import {
  EntityValue,
  EntityValues,
} from '@irontec-voip/ivoz-ui/services/entity/EntityService';

export type InvoicePropertyList<T> = {
  number?: T;
  inDate?: T;
  outDate?: T;
  totalWithTax?: T;
  pdf?: T;
};

export type InvoiceProperties = InvoicePropertyList<Partial<PropertySpec>>;
export type InvoicePropertiesList = Array<
  InvoicePropertyList<EntityValue | EntityValues>
>;
