import { PropertySpec } from '@irontec-voip/ivoz-ui/services/api/ParsedApiSpecInterface';
import {
  EntityValue,
  EntityValues,
} from '@irontec-voip/ivoz-ui/services/entity/EntityService';

export type IvrEntryPropertyList<T> = {
  id?: T;
  ivr?: T;
  entry?: T;
  welcomeLocution?: T;
  displayName?: T;
  routeType?: T;
  numberCountry?: T;
  numberValue?: T;
  extension?: T;
  voicemail?: T;
  conditionalRoute?: T;
  target?: T;
};

export type IvrEntryProperties = IvrEntryPropertyList<Partial<PropertySpec>>;

export type IvrEntryPropertiesList = Array<
  IvrEntryPropertyList<EntityValue | EntityValues>
>;
