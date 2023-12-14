import { PropertySpec } from '@irontec/ivoz-ui/services/api/ParsedApiSpecInterface';
import {
  EntityValue,
  EntityValues,
} from '@irontec/ivoz-ui/services/entity/EntityService';

export type UsersCdrPropertyList<T> = {
  attr?: T;
  startTime?: T;
  duration?: T;
  direction?: T;
  caller?: T;
  callee?: T;
  party?: T;
  disposition?: T;
  owner?: T;
};

export type UsersCdrProperties = UsersCdrPropertyList<Partial<PropertySpec>>;
export type UsersCdrRow = UsersCdrPropertyList<EntityValue | EntityValues>;
export type UsersCdrRows = Array<UsersCdrRow>;
