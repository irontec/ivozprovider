import { PropertySpec } from '@irontec/ivoz-ui/services/api/ParsedApiSpecInterface';
import {
  EntityValue,
  EntityValues,
} from '@irontec/ivoz-ui/services/entity/EntityService';

export type WebhookPropertyList<T> = {
  name?: T;
  description?: T;
  uri?: T;
  eventStart?: T;
  eventRing?: T;
  eventAnswer?: T;
  eventEnd?: T;
  template?: T;
  id?: T;
  company?: T;
  ddi?: T;
};

export type WebhookProperties = WebhookPropertyList<Partial<PropertySpec>>;
export type WebhookPropertiesList = Array<
  WebhookPropertyList<EntityValue | EntityValues>
>;
