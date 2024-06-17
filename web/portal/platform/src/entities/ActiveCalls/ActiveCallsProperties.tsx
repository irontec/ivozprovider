import { PropertySpec } from '@irontec-voip/ivoz-ui/services/api/ParsedApiSpecInterface';
import {
  EntityValue,
  EntityValues,
} from '@irontec-voip/ivoz-ui/services/entity/EntityService';

export type ActiveCallPropertyList<T> = {
  Event?: T;
  Time?: T;
  ID?: T;
  'Call-ID'?: T;
  Caller?: T;
  Callee?: T;
  Brand?: T;
  Company?: T;
  Direction?: T;
  Carrier?: T;
  DdiProvider?: T;
};

export type ActiveCallProperties = ActiveCallPropertyList<
  Partial<PropertySpec>
>;

export type ActiveCallPropertiesList = Array<
  ActiveCallPropertyList<EntityValue | EntityValues>
>;
