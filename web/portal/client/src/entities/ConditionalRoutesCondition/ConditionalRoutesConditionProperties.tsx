import { PropertySpec } from '@irontec/ivoz-ui/services/api/ParsedApiSpecInterface';
import {
  EntityValue,
  EntityValues,
} from '@irontec/ivoz-ui/services/entity/EntityService';

export type ConditionalRoutesConditionPropertyList<T> = {
  id?: T;
  conditionalRoute?: T;
  priority?: T;
  matchListIds?: T;
  scheduleIds?: T;
  calendarIds?: T;
  routeLockIds?: T;
  ConditionMatch?: T;
  locution?: T;
  routeType?: T;
  ivr?: T;
  huntGroup?: T;
  voicemail?: T;
  user?: T;
  numberCountry?: T;
  numberValue?: T;
  friendValue?: T;
  queue?: T;
  conferenceRoom?: T;
  extension?: T;
  target?: T;
};

export type ConditionalRoutesConditionProperties =
  ConditionalRoutesConditionPropertyList<Partial<PropertySpec>>;
export type ConditionalRoutesConditionPropertiesList = Array<
  ConditionalRoutesConditionPropertyList<EntityValue | EntityValues>
>;
