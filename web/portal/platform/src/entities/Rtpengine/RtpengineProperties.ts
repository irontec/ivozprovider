import { PropertySpec } from '@irontec/ivoz-ui/services/api/ParsedApiSpecInterface';
import {
  EntityValue,
  EntityValues,
} from '@irontec/ivoz-ui/services/entity/EntityService';

export type RtpenginePropertyList<T> = {
  setid?: T;
  url?: T;
  weight?: T;
  disabled?: T;
  stamp?: T;
  description?: T;
  id?: T;
  mediaRelaySet?: T;
};

export type RtpengineProperties = RtpenginePropertyList<Partial<PropertySpec>>;
export type RtpenginePropertiesList = Array<
  RtpenginePropertyList<EntityValue | EntityValues>
>;
