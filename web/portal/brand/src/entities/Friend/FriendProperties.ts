import { PropertySpec } from '@irontec/ivoz-ui/services/api/ParsedApiSpecInterface';
import {
  EntityValue,
  EntityValues,
} from '@irontec/ivoz-ui/services/entity/EntityService';

export type FriendPropertyList<T> = {
  name?: T;
  description?: T;
  transport?: T;
  ip?: T;
  port?: T;
  password?: T;
  priority?: T;
  allow?: T;
  fromUser?: T;
  fromDomain?: T;
  directConnectivity?: T;
  ddiIn?: T;
  t38Passthrough?: T;
  id?: T;
  company?: T;
  transformationRuleSet?: T;
  outgoingDdi?: T;
  language?: T;
  interCompany?: T;
  domain?: T;
  domainName?: T;
  status?: T;
};

export type FriendProperties = FriendPropertyList<Partial<PropertySpec>>;
export type FriendPropertiesList = Array<
  FriendPropertyList<EntityValue | EntityValues>
>;
