import { PropertySpec } from '@irontec/ivoz-ui/services/api/ParsedApiSpecInterface';
import { EntityValue, EntityValues } from '@irontec/ivoz-ui/services/entity/EntityService';

export type UsersCdrPropertyList<T> = {
  'attr'?: T,
  'startTime'?: T,
  'duration'?: T,
  'direction'?: T,
  'caller'?: T,
  'callee'?: T,
  'callid'?: T,
  'xcallid'?: T,
  'callidHash'?: T,
  'party'?: T,

  //////
  'owner'?: T,
  'ownerId'?: T,
  'ownerLink'?: T,

  'user'?: T,
  'userId'?: T,
  'userLink'?: T,

  'friend'?: T,
  'friendId'?: T,
  'friendLink'?: T,

  'retailAccount'?: T,
  'retailAccountId'?: T,
  'retailAccountLink'?: T,

  'residentialDevice'?: T,
  'residentialDeviceId'?: T,
  'residentialDeviceLink'?: T,
};

export type UsersCdrProperties = UsersCdrPropertyList<Partial<PropertySpec>>;
export type UsersCdrRow = UsersCdrPropertyList<EntityValue | EntityValues>;
export type UsersCdrRows = Array<UsersCdrRow>;