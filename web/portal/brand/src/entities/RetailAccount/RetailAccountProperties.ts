import { PropertySpec } from '@irontec/ivoz-ui/services/api/ParsedApiSpecInterface';
import {
  EntityValue,
  EntityValues,
} from '@irontec/ivoz-ui/services/entity/EntityService';

export type RetailAccountPropertyList<T> = {
  name?: T;
  domain?: T;
  description?: T;
  transport?: T;
  ip?: T;
  port?: T;
  password?: T;
  fromDomain?: T;
  directConnectivity?: T;
  ddiIn?: T;
  t38Passthrough?: T;
  rtpEncryption?: T;
  multiContact?: T;
  id?: T;
  company?: T;
  transformationRuleSet?: T;
  outgoingDdi?: T;
  domainName?: T;
  status?: T;
  statusIcon?: T;
};

export type RetailAccountStatus = {
  contact: string;
  publicContact: boolean;
  expires: string;
  publicReceived: boolean;
  received: string;
  userAgent: string;
};

export type RetailAccountProperties = RetailAccountPropertyList<
  Partial<PropertySpec>
>;
export type RetailAccountPropertiesList = Array<
  RetailAccountPropertyList<EntityValue | EntityValues>
>;
