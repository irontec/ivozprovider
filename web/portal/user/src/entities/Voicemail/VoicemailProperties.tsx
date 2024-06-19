import { PropertySpec } from '@irontec/ivoz-ui/services/api/ParsedApiSpecInterface';
import {
  EntityValue,
  EntityValues,
} from '@irontec/ivoz-ui/services/entity/EntityService';

export type VoicemailPropertyList<T> = {
  id?: T;
  enabled?: T;
  user?: T;
  name?: T;
  email?: T;
  sendMail?: T;
  attachSound?: T;
  voicemail?: T;
  relUserIds?: T;
};

export type VoicemailProperties = VoicemailPropertyList<Partial<PropertySpec>>;
export type VoicemailPropertiesList = Array<
  VoicemailPropertyList<EntityValue | EntityValues>
>;
