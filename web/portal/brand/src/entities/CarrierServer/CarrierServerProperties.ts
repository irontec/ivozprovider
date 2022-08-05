import { PropertySpec } from '@irontec/ivoz-ui/services/api/ParsedApiSpecInterface';
import { EntityValue, EntityValues } from '@irontec/ivoz-ui/services/entity/EntityService';

export type CarrierServerPropertyList<T> = {
  ip?: T;
  hostname?: T;
  port?: T;
  uriScheme?: T;
  transport?: T;
  sendPAI?: T;
  sendRPID?: T;
  authNeeded?: T;
  authUser?: T;
  authPassword?: T;
  sipProxy?: T;
  outboundProxy?: T;
  fromUser?: T;
  fromDomain?: T;
  id?: T;
  carrier?: T;
};

export type CarrierServerProperties = CarrierServerPropertyList<Partial<PropertySpec>>;
export type CarrierServerPropertiesList = Array<CarrierServerPropertyList<EntityValue | EntityValues>>;
