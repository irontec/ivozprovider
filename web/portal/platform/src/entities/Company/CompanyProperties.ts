import { PropertySpec } from '@irontec/ivoz-ui/services/api/ParsedApiSpecInterface';
import {
  EntityValue,
  EntityValues,
} from '@irontec/ivoz-ui/services/entity/EntityService';

export type CompanyPropertyList<T> = {
  type?: T;
  name?: T;
  domainUsers?: T;
  distributeMethod?: T;
  maxCalls?: T;
  maxDailyUsage?: T;
  currentDayUsage?: T;
  maxDailyUsageEmail?: T;
  ipfilter?: T;
  onDemandRecord?: T;
  allowRecordingRemoval?: T;
  onDemandRecordCode?: T;
  externallyextraopts?: T;
  recordingsLimitMB?: T;
  recordingsLimitEmail?: T;
  billingMethod?: T;
  balance?: T;
  showInvoices?: T;
  id?: T;
  invoicing?: T;
  language?: T;
  mediaRelaySets?: T;
  defaultTimezone?: T;
  brand?: T;
  applicationServer?: T;
  country?: T;
  currency?: T;
  outgoingDdi?: T;
  voicemailNotificationTemplate?: T;
  faxNotificationTemplate?: T;
  invoiceNotificationTemplate?: T;
  callCsvNotificationTemplate?: T;
  maxDailyUsageNotificationTemplate?: T;
  domainName?: T;
};

export type CompanyProperties = CompanyPropertyList<Partial<PropertySpec>>;
export type CompanyPropertiesList = Array<
  CompanyPropertyList<EntityValue | EntityValues>
>;
