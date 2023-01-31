import { PropertySpec } from '@irontec/ivoz-ui/services/api/ParsedApiSpecInterface';
import {
  EntityValue,
  EntityValues,
} from '@irontec/ivoz-ui/services/entity/EntityService';

export type BrandPropertyList<T> = {
  name?: T;
  domainUsers?: T;
  maxCalls?: T;
  id?: T;
  logo?: T;
  invoice?: T;
  language?: T;
  defaultTimezone?: T;
  currency?: T;
  voicemailNotificationTemplate?: T;
  faxNotificationTemplate?: T;
  invoiceNotificationTemplate?: T;
  callCsvNotificationTemplate?: T;
  maxDailyUsageNotificationTemplate?: T;
  features?: T;
  proxyTrunks?: T;
  nif?: T;
  postalAddress?: T;
  postalCode?: T;
  city?: T;
  province?: T;
  country?: T;
  registerInfo?: T;
};

export type BrandProperties = BrandPropertyList<Partial<PropertySpec>>;
export type BrandPropertiesList = Array<
  BrandPropertyList<EntityValue | EntityValues>
>;
