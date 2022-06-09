import { PropertySpec } from "@irontec/ivoz-ui/services/api/ParsedApiSpecInterface";
import {
  EntityValue,
  EntityValues,
} from "@irontec/ivoz-ui/services/entity/EntityService";

export type VoicemailMessagePropertyList<T> = {
  status?: T;
  calldate?: T;
  folder?: T;
  caller?: T;
  duration?: T;
  recordingFile?: T;
  voicemail?: T;
};

export type VoicemailMessageProperties = VoicemailMessagePropertyList<
  Partial<PropertySpec>
>;
export type VoicemailMessagePropertiesList = Array<
  VoicemailMessagePropertyList<EntityValue | EntityValues>
>;
