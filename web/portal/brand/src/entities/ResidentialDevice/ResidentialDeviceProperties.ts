import { PropertySpec } from '@irontec-voip/ivoz-ui/services/api/ParsedApiSpecInterface';
import {
  EntityValue,
  EntityValues,
} from '@irontec-voip/ivoz-ui/services/entity/EntityService';

export type ResidentialDevicePropertyList<T> = {
  name?: T;
  description?: T;
  transport?: T;
  ip?: T;
  port?: T;
  password?: T;
  allow?: T;
  fromDomain?: T;
  directConnectivity?: T;
  ddiIn?: T;
  maxCalls?: T;
  t38Passthrough?: T;
  rtpEncryption?: T;
  multiContact?: T;
  id?: T;
  company?: T;
  transformationRuleSet?: T;
  outgoingDdi?: T;
  language?: T;
  domain?: T;
  domainName?: T;
  status?: T;
  statusIcon?: T;
  disallow?: T;
  directMediaMethod?: T;
  calleridUpdateHeader?: T;
  updateCallerid?: T;
  ruriDomain?: T;
  proxyUser?: T;
};

export type ResidentialDeviceProperties = ResidentialDevicePropertyList<
  Partial<PropertySpec>
>;
export type ResidentialDevicePropertiesList = Array<
  ResidentialDevicePropertyList<EntityValue | EntityValues>
>;
