import { PropertySpec } from '@irontec/ivoz-ui/services/api/ParsedApiSpecInterface';
import {
  EntityValue,
  EntityValues,
} from '@irontec/ivoz-ui/services/entity/EntityService';

export type CompanyPropertyList<T> = {
  type?: T;
  name?: T;
  domainUsers?: T;
  nif?: T;
  maxCalls?: T;
  maxDailyUsage?: T;
  maxDailyUsageEmail?: T;
  postalAddress?: T;
  postalCode?: T;
  town?: T;
  province?: T;
  countryName?: T;
  ipfilter?: T;
  onDemandRecord?: T;
  onDemandRecordCode?: T;
  allowRecordingRemoval?: T;
  recordingsLimitMb?: T;
  recordingsDiskUsage?: T;
  recordingsLimitEmail?: T;
  externallyextraopts?: T;
  billingMethod?: T;
  balance?: T;
  currentDayUsage?: T;
  currentDayMaxUsage?: T;
  typeIcon?: T;
  accountStatus?: T;
  showInvoices?: T;
  id?: T;
  language?: T;
  defaultTimezone?: T;
  country?: T;
  currency?: T;
  distributeMethod?: T;
  applicationServer?: T;
  transformationRuleSet?: T;
  outgoingDdi?: T;
  outgoingDdiE164?: T;
  outgoingDdiRule?: T;
  voicemailNotificationTemplate?: T;
  faxNotificationTemplate?: T;
  invoiceNotificationTemplate?: T;
  callCsvNotificationTemplate?: T;
  maxDailyUsageNotificationTemplate?: T;
  featureIds?: T;
  geoIpAllowedCountries?: T;
  routingTagIds?: T;
  codecIds?: T;
};

export type CompanyProperties = CompanyPropertyList<Partial<PropertySpec>>;
export type CompanyPropertiesList = Array<
  CompanyPropertyList<EntityValue | EntityValues>
>;
