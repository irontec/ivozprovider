import { PropertySpec } from '@irontec/ivoz-ui/services/api/ParsedApiSpecInterface';
import {
  EntityValue,
  EntityValues,
} from '@irontec/ivoz-ui/services/entity/EntityService';

export type DdiPropertyList<T> = {
  ddi?: T;
  ddie164?: T;
  description?: T;
  recordCalls?: T;
  displayName?: T;
  routeType?: T;
  friendValue?: T;
  type?: T;
  id?: T;
  company?: T;
  brand?: T;
  language?: T;
  ddiProvider?: T;
  country?: T;
};

export type DdiProperties = DdiPropertyList<Partial<PropertySpec>>;
export type DdiPropertiesList = Array<
  DdiPropertyList<EntityValue | EntityValues>
>;
