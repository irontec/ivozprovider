import { PropertySpec } from '@irontec/ivoz-ui/services/api/ParsedApiSpecInterface';
import {
  EntityValue,
  EntityValues,
} from '@irontec/ivoz-ui/services/entity/EntityService';

export type SurvivalDevicePropertyList<T> = {
  id?: T;
  name?: T;
  proxy?: T;
  outboundProxy?: T;
  description?: T;
  udpPort?: T;
  tcpPort?: T;
  tlsPort?: T;
  wssPort?: T;
};

export type SurvivalDeviceProperties = SurvivalDevicePropertyList<
  Partial<PropertySpec>
>;
export type SurvivalDevicePropertiesList = Array<
  SurvivalDevicePropertyList<EntityValue | EntityValues>
>;
