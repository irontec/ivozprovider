import { PropertySpec } from '@irontec/ivoz-ui/services/api/ParsedApiSpecInterface';
import {
  EntityValue,
  EntityValues,
} from '@irontec/ivoz-ui/services/entity/EntityService';

export type NotificationTemplateContentPropertyList<T> = {
  fromName?: T;
  fromAddress?: T;
  subject?: T;
  body?: T;
  bodyType?: T;
  id?: T;
  notificationTemplate?: T;
  voicemailVariables?: T;
  faxVariables?: T;
  invoiceVariables?: T;
  lowBalanceVariables?: T;
  callCsvVariables?: T;
  maxDailyUsageVariables?: T;
  language?: T;
};

export type NotificationTemplateContentProperties =
  NotificationTemplateContentPropertyList<Partial<PropertySpec>>;
export type NotificationTemplateContentPropertiesList = Array<
  NotificationTemplateContentPropertyList<EntityValue | EntityValues>
>;
