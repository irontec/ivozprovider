import { PropertySpec } from '@irontec/ivoz-ui/services/api/ParsedApiSpecInterface';
import {
  EntityValue,
  EntityValues,
} from '@irontec/ivoz-ui/services/entity/EntityService';

export type RecordingPropertyList<T> = {
  callid?: T;
  calldate?: T;
  duration?: T;
  caller?: T;
  callee?: T;
  recorder?: T;
  type?: T;
  typeGhost?: T;
  recordedFile?: T;
};

export type RecordingProperties = RecordingPropertyList<Partial<PropertySpec>>;
export type RecordingPropertiesList = Array<
  RecordingPropertyList<EntityValue | EntityValues>
>;
