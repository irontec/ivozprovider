import { PropertySpec } from '@irontec/ivoz-ui/services/api/ParsedApiSpecInterface';
import {
  EntityValue,
  EntityValues,
} from '@irontec/ivoz-ui/services/entity/EntityService';

export type UserPropertyList<T> = {
  active?: T;
  bossAssistant?: T;
  doNotDisturb?: T;
  email?: T;
  extension?: T;
  externalIpCalls?: T;
  gsQrCode?: T;
  id?: T;
  isBoss?: T;
  lastname?: T;
  maxCalls?: T;
  multiContact?: T;
  name?: T;
  oldPass?: T;
  pass?: T;
  rejectCallMethod?: T;
  timezone?: T;
  voicemail?: T;
  changePassword?: T;
  repeatPass?: T;
};

export type UserProperties = UserPropertyList<Partial<PropertySpec>>;
export type UserPropertiesList = Array<
  UserPropertyList<EntityValue | EntityValues>
>;
