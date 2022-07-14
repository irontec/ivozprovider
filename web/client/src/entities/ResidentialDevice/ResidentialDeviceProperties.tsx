import { PropertySpec } from '@irontec/ivoz-ui/services/api/ParsedApiSpecInterface';
import {
  EntityValue,
  EntityValues,
} from '@irontec/ivoz-ui/services/entity/EntityService';

export type ResidentialDevicePropertyList<T> = {
  name: T;
  domainName: T;
  description: T;
  transport: T;
  ip: T;
  port: T;
  password: T;
  outgoingDdi: T;
  disallow: T;
  allow: T;
  directMediaMethod: T;
  ddiIn: T;
  language: T;
  transformationRuleSet: T;
  calleridUpdateHeader: T;
  updateCallerid: T;
  fromDomain: T;
  maxCalls: T;
  t38Passthrough: T;
  rtpEncryption: T;
  multiContact: T;
  status: T;
  statusIcon: T;
  directConnectivity: T;
};

export type ResidentialDeviceStatus = {
  contact: string;
  publicContact: boolean;
  expires: string;
  publicReceived: boolean;
  received: string;
  userAgent: string;
};

export type ResidentialDeviceProperties = ResidentialDevicePropertyList<
  Partial<PropertySpec>
>;
export type ResidentialDevicePropertiesList = Array<
  ResidentialDevicePropertyList<EntityValue | EntityValues>
>;
