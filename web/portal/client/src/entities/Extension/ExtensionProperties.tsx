import { PropertySpec } from '@irontec/ivoz-ui/services/api/ParsedApiSpecInterface';
import {
  EntityValue,
  EntityValues,
} from '@irontec/ivoz-ui/services/entity/EntityService';

export type ExtensionPropertyList<T> = {
  number?: T;
  routeType?: T;
  numberCountry?: T;
  numberValue?: T;
  ivr?: T;
  huntGroup?: T;
  conferenceRoom?: T;
  user?: T;
  friendValue?: T;
  queue?: T;
  conditionalRoute?: T;
  voicemail?: T;
  target?: T;
};

export type ExtensionProperties = ExtensionPropertyList<Partial<PropertySpec>>;

export type ExtensionPropertiesList = Array<
  ExtensionPropertyList<EntityValue | EntityValues>
>;
