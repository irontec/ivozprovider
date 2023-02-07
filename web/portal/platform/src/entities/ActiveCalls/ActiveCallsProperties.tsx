import { PropertySpec } from '@irontec/ivoz-ui/services/api/ParsedApiSpecInterface';
import {
  EntityValue,
  EntityValues,
} from '@irontec/ivoz-ui/services/entity/EntityService';

export type ActiveCallsPropertyList<T> = {
  Event?: T;
  Time?: T;
  ID?: T;
  'Call-ID'?: T;
  Caller?: T;
  Callee?: T;
  Brand?: T;
  Company?: T;
  Direction?: T;
  DdiProvider?: T;
};

export type ActiveCallsProperties = ActiveCallsPropertyList<
  Partial<PropertySpec>
>;

export type ActiveCallsPropertiesList = Array<
  ActiveCallsPropertyList<EntityValue | EntityValues>
>;
