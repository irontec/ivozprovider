import { PropertySpec } from '@irontec/ivoz-ui/services/api/ParsedApiSpecInterface';
import {
  EntityValue,
  EntityValues,
} from '@irontec/ivoz-ui/services/entity/EntityService';

export type FixedCostsRelInvoiceSchedulerPropertyList<T> = {
  quantity?: T;
  quantityGhost?: T;
  id?: T;
  type?: T;
  ddisCountryMatch?: T;
  ddisCountry?: T;
  fixedCost?: T;
  invoiceScheduler?: T;
};

export type FixedCostsRelInvoiceSchedulerProperties =
  FixedCostsRelInvoiceSchedulerPropertyList<Partial<PropertySpec>>;
export type FixedCostsRelInvoiceSchedulerPropertiesList = Array<
  FixedCostsRelInvoiceSchedulerPropertyList<EntityValue | EntityValues>
>;
