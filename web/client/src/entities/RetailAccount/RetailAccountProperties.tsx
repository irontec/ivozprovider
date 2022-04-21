import { PropertySpec } from '@irontec/ivoz-ui/services/api/ParsedApiSpecInterface';
import { EntityValue, EntityValues } from '@irontec/ivoz-ui/services/entity/EntityService';

export type RetailAccountPropertyList<T> = {
  company?: T,
  name?: T,
  domain?: T,
  domainName?: T,
  description?: T,
  transport?: T,
  ip?: T,
  port?: T,
  password?: T,
  outgoingDdi?: T,
  fromDomain?: T,
  directConnectivity?: T,
  ddiIn?: T,
  statusIcon?: T,
  status?: T,
  transformationRuleSet?: T,
  t38Passthrough?: T,
  rtpEncryption?: T,
  multiContact?: T,
};

export type RetailAccountStatus = {
  contact: string,
  publicContact: boolean,
  expires: string,
  publicReceived: boolean,
  received: string,
  userAgent: string,
};

export type RetailAccountProperties = RetailAccountPropertyList<Partial<PropertySpec>>;
export type RetailAccountPropertiesList = Array<RetailAccountPropertyList<EntityValue | EntityValues>>;