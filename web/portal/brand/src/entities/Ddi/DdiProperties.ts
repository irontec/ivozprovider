import { PropertySpec } from '@irontec/ivoz-ui/services/api/ParsedApiSpecInterface';
import {
  EntityValue,
  EntityValues,
} from '@irontec/ivoz-ui/services/entity/EntityService';

export type DdiPropertyList<T> = {
  ddi?: T;
  externalCallFilter?: T;
  routeType?: T;
  recordCalls?: T;
  displayName?: T;
  user?: T;
  ivr?: T;
  huntGroup?: T;
  fax?: T;
  conferenceRoom?: T;
  residentialDevice?: T;
  friendValue?: T;
  country?: T;
  language?: T;
  queue?: T;
  conditionalRoute?: T;
  retailAccount?: T;
  target?: T;
};

export type DdiProperties = DdiPropertyList<Partial<PropertySpec>>;
export type DdiPropertiesList = Array<
  DdiPropertyList<EntityValue | EntityValues>
>;
