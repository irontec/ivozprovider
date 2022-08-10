import { PropertySpec } from '@irontec/ivoz-ui/services/api/ParsedApiSpecInterface';
import {
  EntityValue,
  EntityValues,
} from '@irontec/ivoz-ui/services/entity/EntityService';

export type BalanceNotificationPropertyList<T> = {
  toAddress?: T;
  threshold?: T;
  lastSent?: T;
  id?: T;
  company?: T;
  carrier?: T;
  notificationTemplate?: T;
};

export type BalanceNotificationProperties = BalanceNotificationPropertyList<
  Partial<PropertySpec>
>;
export type BalanceNotificationPropertiesList = Array<
  BalanceNotificationPropertyList<EntityValue | EntityValues>
>;
