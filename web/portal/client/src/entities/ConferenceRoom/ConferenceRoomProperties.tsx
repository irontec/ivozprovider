import { PropertySpec } from '@irontec-voip/ivoz-ui/services/api/ParsedApiSpecInterface';
import {
  EntityValue,
  EntityValues,
} from '@irontec-voip/ivoz-ui/services/entity/EntityService';

export type ConferenceRoomPropertyList<T> = {
  attr?: T;
  name?: T;
  pinProtected?: T;
  pinCode?: T;
  maxMembers?: T;
  announceUserCount?: T;
};

export type ConferenceRoomProperties = ConferenceRoomPropertyList<
  Partial<PropertySpec>
>;
export type ConferenceRoomPropertiesList = Array<
  ConferenceRoomPropertyList<EntityValue | EntityValues>
>;
