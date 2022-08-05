import { PropertySpec } from '@irontec/ivoz-ui/services/api/ParsedApiSpecInterface';
import { EntityValue, EntityValues } from '@irontec/ivoz-ui/services/entity/EntityService';

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
  id?: T;
  company?: T;
  transformationRuleSet?: T;
  outgoingDdi?: T;
  language?: T;
  domainName?: T;
  status?: T;
};

export type ResidentialDeviceProperties = ResidentialDevicePropertyList<Partial<PropertySpec>>;
export type ResidentialDevicePropertiesList = Array<ResidentialDevicePropertyList<EntityValue | EntityValues>>;
