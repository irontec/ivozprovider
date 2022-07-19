import { PropertySpec } from '@irontec/ivoz-ui/services/api/ParsedApiSpecInterface';
import {
  EntityValue,
  EntityValues,
} from '@irontec/ivoz-ui/services/entity/EntityService';

export type UsersCdrPropertyList<T> = {
  startTime?: T;
  endTime?: T;
  duration?: T;
  direction?: T;
  caller?: T;
  callee?: T;
  diversion?: T;
  referee?: T;
  referrer?: T;
  callid?: T;
  callidHash?: T;
  xcallid?: T;
  id?: T;
  user?: T;
};

export type UsersCdrProperties = UsersCdrPropertyList<Partial<PropertySpec>>;
export type UsersCdrPropertiesList = Array<
  UsersCdrPropertyList<EntityValue | EntityValues>
>;
