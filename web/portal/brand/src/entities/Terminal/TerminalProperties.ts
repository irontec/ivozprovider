import { PropertySpec } from '@irontec/ivoz-ui/services/api/ParsedApiSpecInterface';
import {
  EntityValue,
  EntityValues,
} from '@irontec/ivoz-ui/services/entity/EntityService';

export type TerminalPropertyList<T> = {
  name?: T;
  disallow?: T;
  allowAudio?: T;
  allowVideo?: T;
  directMediaMethod?: T;
  password?: T;
  mac?: T;
  lastProvisionDate?: T;
  t38Passthrough?: T;
  rtpEncryption?: T;
  id?: T;
  company?: T;
  domain?: T;
  domainName?: T;
  status?: T;
};

export type TerminalProperties = TerminalPropertyList<Partial<PropertySpec>>;
export type TerminalPropertiesList = Array<
  TerminalPropertyList<EntityValue | EntityValues>
>;
