import { PropertySpec } from '@irontec/ivoz-ui/services/api/ParsedApiSpecInterface';
import {
  EntityValue,
  EntityValues,
} from '@irontec/ivoz-ui/services/entity/EntityService';

export type UsersCdrPropertyList<T> = {
  startTime?: T;
  owner?: T;
  direction?: T;
  caller?: T;
  callee?: T;
  duration?: T;
  disposition?: T;
  id?: T;
};

export type UsersCdrProperties = UsersCdrPropertyList<Partial<PropertySpec>>;
export type UsersCdrPropertiesList = Array<
  UsersCdrPropertyList<EntityValue | EntityValues>
>;
