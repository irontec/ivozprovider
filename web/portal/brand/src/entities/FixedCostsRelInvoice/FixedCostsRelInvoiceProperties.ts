import { PropertySpec } from '@irontec/ivoz-ui/services/api/ParsedApiSpecInterface';
import {
  EntityValue,
  EntityValues,
} from '@irontec/ivoz-ui/services/entity/EntityService';

export type FixedCostsRelInvoicePropertyList<T> = {
  quantity?: T;
  id?: T;
  fixedCost?: T;
  invoice?: T;
};

export type FixedCostsRelInvoiceProperties = FixedCostsRelInvoicePropertyList<
  Partial<PropertySpec>
>;
export type FixedCostsRelInvoicePropertiesList = Array<
  FixedCostsRelInvoicePropertyList<EntityValue | EntityValues>
>;
