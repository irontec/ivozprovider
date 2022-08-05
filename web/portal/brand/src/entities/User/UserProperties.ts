import { PropertySpec } from '@irontec/ivoz-ui/services/api/ParsedApiSpecInterface';
import { EntityValue, EntityValues } from '@irontec/ivoz-ui/services/entity/EntityService';

export type UserPropertyList<T> = {
  name?: T;
  lastname?: T;
  email?: T;
  pass?: T;
  doNotDisturb?: T;
  isBoss?: T;
  active?: T;
  maxCalls?: T;
  externalIpCalls?: T;
  rejectCallMethod?: T;
  multiContact?: T;
  gsQRCode?: T;
  id?: T;
  company?: T;
  bossAssistant?: T;
  transformationRuleSet?: T;
  language?: T;
  terminal?: T;
  timezone?: T;
  outgoingDdi?: T;
  oldPass?: T;
};

export type UserProperties = UserPropertyList<Partial<PropertySpec>>;
export type UserPropertiesList = Array<UserPropertyList<EntityValue | EntityValues>>;
